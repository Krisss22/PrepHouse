<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\QuestionsBank;
use App\Models\Vacancy;
use App\Models\Tag;
use Illuminate\Http\Request;

class QuestionsBankController extends AdminController
{

    protected $sectionName = 'questions';

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
            if ($request->has('inputTag') && $request->input('inputTag') !== 'empty') {
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
                    'answer' => $request->input('inputUserAnswer'),
                    'addedByAdmin' => (int) $request->input('inputAddedByAdmin') ?? 0,
                    'release' => (int) $request->input('inputRelease') ?? 0,
                ]);

            $answerIds = [];
            $questionAnswerIds = [];
            foreach ($question->answers as $answer) {
                $questionAnswerIds[] = $answer->id;
            }

            if ($request->has('textAnswer')) {
                foreach ($request->textAnswer as $answerId => $text) {
                    $answerIds[] = $answerId;
                    Answer::findOrFail($answerId)->update([
                        'text' => $text
                    ]);
                }
            }

           if ($request->has('fileAnswerHidden')) {
               foreach ($request->fileAnswerHidden as $answerId => $text) {
                   $answerIds[] = $answerId;
               }
           }

           if ($request->hasFile('fileAnswer')) {
               foreach ($request->file('fileAnswer') as $answerId => $image) {
                   $answer = Answer::findOrFail($answerId);
                   if (file_exists(public_path(Answer::IMAGES_PATH) . '/' . $answer->image)) {
                       unlink(public_path(Answer::IMAGES_PATH) . '/' . $answer->image);
                   }
                   $imageName = time() . '.' . $image->extension();
                   $image->move(public_path(Answer::IMAGES_PATH), $imageName);
                   $answer->update([
                       'image' => $imageName
                   ]);

               }
           }

           foreach ($question->answers as $answer) {
               if (!in_array($answer->id, $answerIds)) {
                   $answer->delete();
               }
           }

            if ($request->has('newTextAnswer')) {
                foreach ($request->newTextAnswer as $text) {
                   Answer::create([
                       'text' => $text,
                       'question_id' => $id
                   ]);
                }
            }

            if ($request->hasFile('newFileAnswer')) {
                foreach ($request->file('newFileAnswer') as $image) {
                   $imageName = time() . '.' . $image->extension();
                   $image->move(public_path(Answer::IMAGES_PATH), $imageName);
                   Answer::create([
                       'image' => $imageName,
                       'question_id' => $id
                   ]);
                }
            }
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
                'answer' => $request->input('inputUserAnswer'),
                'addedByAdmin' => (int) $request->input('inputAddedByAdmin') ?? 0,
                'release' => (int) $request->input('inputRelease') ?? 0
            ]);

            if ($request->has('newTextAnswer')) {
                foreach ($request->newTextAnswer as $text) {
                    Answer::create([
                        'text' => $text,
                        'question_id' => $question->id
                    ]);
                }
            }

            if ($request->hasFile('newFileAnswer')) {
                foreach ($request->file('newFileAnswer') as $image) {
                    $imageName = time() . '.' . $image->extension();
                    $image->move(public_path(Answer::IMAGES_PATH), $imageName);
                    Answer::create([
                        'image' => $imageName,
                        'question_id' => $question->id
                    ]);
                }
            }

            return redirect('/admin/questions/list');
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'question' => new QuestionsBank(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
