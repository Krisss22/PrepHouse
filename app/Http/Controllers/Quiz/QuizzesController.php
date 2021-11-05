<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\QuestionsBank;
use App\Models\Quiz;
use App\Models\QuizAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuizzesController extends Controller
{

    protected $sectionName = 'quizzes';

    public function index()
    {
        $quiz = Quiz::query();

        return view('quiz/list', [
            'quizzesList' => $quiz->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    protected function runQuiz(int $quizId)
    {
        $userQuizAction = QuizAction::getLastUserQuiz();
        if (isset($userQuizAction) && !$userQuizAction->isFinished()) {
            return redirect('/quiz/' . $userQuizAction->id);
        }

        $quiz = Quiz::findOrFail($quizId);
        $questionsArray = [];
        foreach ($quiz->quizTags as $quizTag) {
            $questions = QuestionsBank::getRandomQuestionsByTagId($quizTag->tag_id, $quizTag->count);
            foreach ($questions as $question) {
                $answers = [];
                foreach ($question->answers as $answer) {
                    $answers[] = [
                        'image' => $answer->image,
                        'text' => $answer->text,
                        'correct' => (bool) $answer->correct,
                    ];
                }
                $questionsArray[] = [
                    'question' => $question->question,
                    'answers' => $answers,
                    'usersAnswer' => null,
                    'flagged' => false,
                ];
            }
        }

        $quizArray = [
            'name' => $quiz->name,
            'questions' => $questionsArray,
        ];

        $quizActionFields = [
            'quiz_id' => $quiz->id,
            'user_id' => null,
            'data' => json_encode($quizArray),
        ];

        $quizAction = QuizAction::create($quizActionFields);
        dd($quizAction);
    }

    public function processQuiz(int $quizActionId)
    {
        $quizAction = QuizAction::findOrFail($quizActionId);
        if ($quizAction->isFinished()) {
            return redirect('/quizzes-list');
        }

        return view('quiz/process', [
            'quizAction' => $quizAction,
            'quizActionData' => $quizAction->getData()
        ]);
    }

    public function quizAnswerProcess(int $quizActionId, Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->isMethod('post')) {
            return Response::json([
                'success' => false,
                'errorMessage' => 'Not allowed method'
            ]);
        }

        return Response::json([
            'success' => true,
            '$quizActionId' => $quizActionId,
//            'x' => $request->input(
        ]);
    }
}
