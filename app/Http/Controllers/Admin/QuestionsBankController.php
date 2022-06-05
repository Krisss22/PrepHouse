<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\QuestionsBank;
use App\Models\Vacancy;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class QuestionsBankController extends AdminController
{

    protected string $sectionName = 'questions';

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $questions = QuestionsBank::query();
        $vacanciesList = Vacancy::all();
        $filter = [
            'inputVacancy' => 'empty',
            'inputTag' => '',
            'inputTagName' => '',
            'inputRelease' => 'empty',
            'inputAddedByAdmin' => 'empty'
        ];

        if ($request->input('inputAction') !== 'Clear') {
            if ($request->has('inputTag') && !empty($request->input('inputTag'))) {
                $filter['inputTag'] = (int) $request->input('inputTag');
                $filter['inputTagName'] = Tag::findOrFail((int) $request->input('inputTag'))->name;
                $questions->where('tag_id', '=', (int) $request->input('inputTag'));
            }
            if ($request->has('inputRelease') && $request->input('inputRelease') !== 'empty') {
                $filter['inputRelease'] = (int) $request->input('inputRelease');
                $questions->where('release', '=', (int) $request->input('inputRelease'));
            }
            if ($request->has('inputAddedByAdmin') && $request->input('inputAddedByAdmin') !== 'empty') {
                $filter['inputAddedByAdmin'] = (int) $request->input('inputAddedByAdmin');
                $questions->where('addedByAdmin', '=', (int) $request->input('inputAddedByAdmin'));
            }
        }

        $questions->orderBy('id', 'DESC');

//        var_dump(Auth::check());
//        var_dump(Auth::user()->name);
//        var_dump(\App\Models\User::ADMIN_ROLE);
//        var_dump(Auth::user()->isAdmin());
        return view('admin/questions/list', [
            'sectionName' => $this->sectionName,
            'vacanciesList' => $vacanciesList,
            'filter' => $filter,
            'questions' => $questions->paginate(self::ITEM_ON_PAGE)->appends($filter),
            'tags' => Tag::all()
        ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('admin/questions/show', [
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'inputQuestion' => 'required|max:1500'
            ]);

            $question = QuestionsBank::findOrFail($id);

            $question->query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'tag_id' => $request->input('inputTag') ? $request->input('inputTag') : null,
                    'question' => $request->input('inputQuestion'),
                    'addedByAdmin' => (int) $request->input('inputAddedByAdmin') ?? 0,
                    'release' => (int) $request->input('inputRelease') ?? 0,
                ]);

            $updateAnswers = [];
            $answerIds = [];

            if ($request->has('textAnswer')) {
                foreach ($request->textAnswer as $answerId => $item) {
                    $updateAnswers[$answerId]['text'] = $item;
                }
            }

            if ($request->has('fileAnswer')) {
                foreach ($request->file('fileAnswer') as $answerId => $image) {
                    $updateAnswers[$answerId]['image'] = $image;
                }
            }

            foreach ($updateAnswers as $answerId => $answerItem) {
                $answer = Answer::findOrFail($answerId);
                $updateArray = [];
                $answerIds[] = $answerId;

                foreach ($answerItem as $answerType => $answerValue) {
                    if ($answerType === 'text') {
                        $updateArray['text'] = $answerValue['value'];
                    }
                    if ($answerType === 'image') {
                        if (file_exists(storage_path('app/public/' . Answer::IMAGES_PATH) . '/' . $answer->image)) {
                            unlink(storage_path('app/public/' . Answer::IMAGES_PATH) . '/' . $answer->image);
                        }

                        $imageName = time() . '.' . $answerValue['value']->extension();
                        $answerValue['value']->move(storage_path('app/public/' . Answer::IMAGES_PATH), $imageName);
                        $updateArray['image'] = $imageName;
                    }
                }

                $updateArray['correct'] = isset($request->isCorrect[$answerId]);

                $answer->update($updateArray);
            }

            foreach ($question->answers as $answer) {
                if (!in_array($answer->id, $answerIds)) {
                    $answer->delete();
                }
            }

            $this->createNewAnswers($request, $question->id);
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id),
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'inputQuestion' => 'required|max:1500'
            ]);

            $question = QuestionsBank::create([
                'tag_id' => $request->input('inputTag') ? $request->input('inputTag') : null,
                'question' => $request->input('inputQuestion'),
                'addedByAdmin' => (int) $request->input('inputAddedByAdmin') ?? 0,
                'release' => (int) $request->input('inputRelease') ?? 0
            ]);

            $this->createNewAnswers($request, $question->id);

            return redirect('/admin/questions/list');
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'question' => new QuestionsBank(),
        ]);
    }

    private function createNewAnswers(Request $request, int $questionId): void
    {
        $answersList = [];

        if ($request->has('newTextAnswer')) {
            foreach ($request->newTextAnswer as $index => $item) {
                $answersList[$index]['text'] = $item;
            }
        }

        if ($request->has('newFileAnswer')) {
            foreach ($request->newFileAnswer as $index => $item) {
                $answersList[$index]['image'] = $item;
            }
        }

        foreach ($answersList as $index => $answerItem) {
            $text = null;
            $image = null;

            foreach ($answerItem as $answerType => $answerValue) {
                if ($answerType === 'text') {
                    $text = $answerValue['value'];
                }
                if ($answerType === 'image') {
                    $image = $answerValue['value']->hashName();
                    $answerValue['value']->move(storage_path('app/public/' . Answer::IMAGES_PATH), $image);
                }
            }

            Answer::create([
                'text' => $text,
                'image' => $image,
                'question_id' => $questionId,
                'correct' => isset($request->isCorrect[$index])
            ]);
        }
    }

    /**
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function delete($id)
    {
        QuestionsBank::findOrFail($id)->delete();

        return redirect('/admin/questions/list');
    }

    public function release($id)
    {
        QuestionsBank::query()
            ->where('id', $id)
            ->limit(1)
            ->update([
                'release' => 1,
            ]);

        return redirect('/admin/questions/list');
    }
}
