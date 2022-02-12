<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\QuestionsBank;
use App\Models\Quiz;
use App\Models\QuizAction;
use App\Services\Quiz\QuizData;
use App\Services\Quiz\QuizService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class QuizzesController extends Controller
{

    protected string $sectionName = 'quizzes';

    public function index()
    {
        if (Auth::check()) {
            $additionalRawQueries = [
                DB::raw('(
                    SELECT quiz_action.finished
                    FROM quiz_action
                    WHERE quiz_action.quiz_id = quizzes.id
                        AND quiz_action.user_id = ' . Auth::user()->id . '
                    ORDER BY quiz_action.id DESC
                    LIMIT 1
                ) as quiz_action_finished'),
                DB::raw('(
                    SELECT quiz_action.data
                    FROM quiz_action
                    WHERE quiz_action.quiz_id = quizzes.id
                        AND quiz_action.user_id = ' . Auth::user()->id . '
                    ORDER BY quiz_action.id DESC
                    LIMIT 1
                ) as quiz_action_data')
            ];
        } else {
            $unloggedQuizActionIds = QuizService::getUnloggedQuizActionIds();
            if (count($unloggedQuizActionIds) > 0) {
                $additionalRawQueries = [
                    DB::raw('(
                    SELECT quiz_action.finished
                    FROM quiz_action
                    WHERE quiz_action.quiz_id = quizzes.id
                        AND quiz_action.id IN (' . implode(', ', $unloggedQuizActionIds) . ')
                    ORDER BY quiz_action.id DESC
                    LIMIT 1
                ) as quiz_action_finished'),
                    DB::raw('(
                    SELECT quiz_action.data
                    FROM quiz_action
                    WHERE quiz_action.quiz_id = quizzes.id
                        AND quiz_action.id IN (' . implode(', ', $unloggedQuizActionIds) . ')
                    ORDER BY quiz_action.id DESC
                    LIMIT 1
                ) as quiz_action_data')
                ];
            } else {
                $additionalRawQueries = [
                    DB::raw("null as quiz_action_finished"),
                    DB::raw("null as quiz_action_data")
                ];
            }
        }

        $quizzesList = Quiz::query()
            ->select([
                'quizzes.*',
                ...$additionalRawQueries
            ])
            ->paginate(self::ITEM_ON_PAGE);

        for ($i = 0; $i < count($quizzesList); $i++) {
            if (isset($quizzesList[$i]->quiz_action_data)) {
                $quizzesList[$i]->quiz_action_data = new QuizData(json_decode($quizzesList[$i]->quiz_action_data, true));
                if ($quizzesList[$i]->quiz_action_finished) {
                    if ($quizzesList[$i]->quiz_action_data->isSuccessful()) {
                        $quizzesList[$i]->processStatusClass = 'finished';
                    } else {
                        $quizzesList[$i]->processStatusClass = 'failed';
                    }
                } else {
                    $quizzesList[$i]->processStatusClass = 'process';
                }
            } else {
                $quizzesList[$i]['processStatusClass'] = 'new';
            }
        }

        return $this->view('quiz/list', [
            'quizzesList' => $quizzesList
        ]);
    }

    protected function runQuiz(int $quizId)
    {
        $userQuizAction = QuizAction::getLastUserQuizById($quizId);
        if (isset($userQuizAction) && !$userQuizAction->isFinished()) {
            return redirect('/quiz/' . $userQuizAction->id);
        }

        $quiz = Quiz::findOrFail($quizId);
        $questionsArray = [];
        $tagsArray = [];
        foreach ($quiz->quizTags as $quizTag) {
            $tagsArray[$quizTag->tag->id] = $quizTag->tag->name;
            $questions = QuestionsBank::getRandomQuestionsByTagId($quizTag->tag_id, $quizTag->count);
            foreach ($questions as $question) {
                $answers = [];
                foreach ($question->answers as $answer) {
                    $answers[] = [
                        'image' => $answer->image,
                        'imageFile' => $answer->image ? base64_encode(file_get_contents(storage_path('app/public/' . Answer::IMAGES_PATH . '/' . $answer->image))) : null,
                        'text' => $answer->text,
                        'correct' => (bool) $answer->correct,
                    ];
                }
                $questionsArray[] = [
                    'question' => $question->question,
                    'answers' => $answers,
                    'usersAnswer' => [],
                    'tagId' => $quizTag->tag->id,
                    'flagged' => false,
                ];
            }
        }

        $quizArray = [
            'name' => $quiz->name,
            'tags' => $tagsArray,
            'questions' => $questionsArray,
        ];

        $quizActionFields = [
            'quiz_id' => $quiz->id,
            'user_id' => null,
            'data' => json_encode($quizArray),
        ];

        if (Auth::check()) {
            $quizActionFields['user_id'] = Auth::user()->id;
        }

        $quizAction = QuizAction::create($quizActionFields);

        if (!Auth::check()) {
            QuizService::addUnloggedQuizActionId($quizAction->id);
        }

        return redirect('/quiz/' . $quizAction->id);
    }

    public function processQuiz(int $quizActionId)
    {
        $quizAction = QuizAction::findOrFail($quizActionId);
        if ($quizAction->isFinished()) {
            return redirect('/quizzes-list');
        }

        $quizActionData = $quizAction->getData();
        $currentQuestion = $quizActionData->questions[0];
        foreach ($quizActionData->questions as $question) {
            if (empty($question->usersAnswer)) {
                $currentQuestion = $question;
                break;
            }
        }

        return $this->view('quiz/process', [
            'quizAction' => $quizAction,
            'quizActionData' => $quizActionData,
            'currentQuestion' => $currentQuestion,
            'previousQuestionId' => isset($quizActionData->questions[$currentQuestion->id - 1]) ? ($currentQuestion->id - 1) : null,
            'nextQuestionId' => isset($quizActionData->questions[$currentQuestion->id + 1]) ? ($currentQuestion->id + 1) : null
        ]);
    }

    public function answerProcess(int $quizActionId, Request $request): JsonResponse
    {
        if (!$request->isMethod('post')) {
            return Response::json([
                'status' => self::RESPONSE_STATUS_ERROR,
                'errorMessage' => 'Not allowed method'
            ]);
        }

        if ($request->json('questionId') === null || $request->json('answerId') === null) {
            return Response::json([
                'status' => self::RESPONSE_STATUS_ERROR,
                'errorMessage' => 'Can not get required params'
            ]);
        }

        $questionId = $request->json('questionId');
        $answerId = $request->json('answerId');

        $quizAction = QuizAction::findOrFail($quizActionId);
        $quizActionData = $quizAction->getData();

        if (!isset($quizActionData->questions[$questionId])) {
            return Response::json([
                'status' => self::RESPONSE_STATUS_ERROR,
                'errorMessage' => 'Not found question by ID'
            ]);
        }

        if (!isset($quizActionData->questions[$questionId]->answers[$answerId])) {
            return Response::json([
                'status' => self::RESPONSE_STATUS_ERROR,
                'errorMessage' => 'Not found answer by ID'
            ]);
        }

        if (in_array($answerId, $quizActionData->questions[$questionId]->usersAnswer)) {
            unset($quizActionData->questions[$questionId]->usersAnswer[(int) $answerId]);
        } else {
            $quizActionData->questions[$questionId]->usersAnswer[] = (int) $answerId;
        }

        $quizAction->data = json_encode($quizActionData);
        $quizAction->save();

        return Response::json([
            'status' => self::RESPONSE_STATUS_SUCCESS,
            'processPercent' => $quizActionData->getProgressPercent(),
        ]);
    }

    public function getQuestion($quizActionId, $questionId): JsonResponse
    {
        $quizAction = QuizAction::findOrFail($quizActionId);
        $quizActionData = $quizAction->getData();
        if (!isset($quizActionData->questions[$questionId])) {
            return Response::json([
                'status' => self::RESPONSE_STATUS_ERROR,
                'errorMessage' => 'Can not find this question'
            ]);
        }

        $questionData = $quizActionData->questions[$questionId];
        $answers = [];
        foreach ($questionData->answers as $answer) {
            $answers[] = [
                'realId' => $answer->id,
                'humanId' => $answer->getHumanId(),
                'text' => $answer->text,
                'image' => $answer->image,
                'imageFile' => $answer->imageFile ?? null,
            ];
        }

        return Response::json([
            'status' => self::RESPONSE_STATUS_SUCCESS,
            'question' => [
                'id' => $questionData->id,
                'question' => $questionData->question,
                'answers' => $answers,
                'usersAnswer' => $questionData->usersAnswer
            ],
            'previousQuestionId' => isset($quizActionData->questions[$questionId - 1]) ? ($questionId - 1) : null,
            'nextQuestionId' => isset($quizActionData->questions[$questionId + 1]) ? ($questionId + 1) : null
        ]);
    }

    public function finish($quizActionId)
    {
        $quizAction = QuizAction::findOrFail($quizActionId);
        $quizAction->finished = true;
        $quizAction->save();

        return redirect('/quiz/statistic/' . $quizActionId);
    }

    public function statisticList() {
        return $this->view('quiz/statistic/list', [
            'statisticItemsList' => QuizAction::getAllUserQuizzesQuery(Auth::user()->id, 1)->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function statistic($quizActionId) {
        $quizAction = QuizAction::findOrFail($quizActionId);

        if ($quizAction->user_id === null) {
            return $this->view('quiz/statistic/unloggedStatistic', [
                'quizAction' => $quizAction,
            ]);
        }

        return $this->view('quiz/statistic/statistic', [
            'quizAction' => $quizAction,
            'quizActionData' => $quizAction->getData()
        ]);
    }
}
