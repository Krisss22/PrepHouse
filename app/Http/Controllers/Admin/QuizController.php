<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\QuizTag;
use Illuminate\Http\Request;

class QuizController extends AdminController
{

    protected string $sectionName = 'quizzes';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin/quizzes/list', [
            'sectionName' => $this->sectionName,
            'quizzes' => Quiz::query()->paginate(self::ITEM_ON_PAGE)
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
                'name' => 'required|max:1000',
                'topic' => 'required'
            ]);

            $quiz = Quiz::findOrFail($id);

            $quiz->query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'name' => $request->input('name'),
                    'topic_id' => $request->input('topic'),
                ]);

            $quizTagIds = [];

            if ($request->has('quizTag')) {
                foreach ($request->quizTag as $quizTagId => $item) {
                    $quizTagIds[] = $quizTagId;
                    QuizTag::findOrFail($quizTagId)->update([
                        'tag_id' => $item['tagId']
                    ]);
                }
            }

            foreach ($quiz->quizTags as $quizTag) {
                if (!in_array($quizTag->id, $quizTagIds)) {
                    $quizTag->delete();
                }
            }

            if ($request->has('newQuizTag')) {
                foreach ($request->newQuizTag as $item) {
                    QuizTag::create([
                        'quiz_id' => $quiz->id,
                        'tag_id' => $item['tagId'],
                        'count' => $item['count']
                    ]);
                }
            }
        }

        return view('admin/quizzes/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'quiz' => Quiz::findOrFail($id),
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
                'name' => 'required|max:1000',
                'topic' => 'required'
            ]);

            $quiz = Quiz::create([
                'name' => $request->input('name'),
                'topic_id' => $request->input('topic')
            ]);

            if ($request->has('newQuizTag')) {
                foreach ($request->newQuizTag as $item) {
                    QuizTag::create([
                        'quiz_id' => $quiz->id,
                        'tag_id' => $item['tagId'],
                        'count' => $item['count']
                    ]);
                }
            }

            return redirect('/admin/quizzes/list');
        }

        return view('admin/quizzes/edit', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'quiz' => new Quiz(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Quiz::findOrFail($id)->delete();

        return redirect('/admin/quizzes/list');
    }

}
