<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\QuizTag;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class QuizController extends AdminController
{

    protected string $sectionName = 'quizzes';

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        if (!$this->checkAccess('quizzes', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/quizzes/list', [
            'sectionName' => $this->sectionName,
            'quizzes' => Quiz::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function edit(Request $request, $id)
    {
        if (!$this->checkAccess('quizzes', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

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
                    'expertise_area_id' => $request->has('expertiseArea') ? $request->input('expertiseArea') : null
                ]);

            $quizTagIds = [];

            if ($request->has('quizTag')) {
                foreach ($request->quizTag as $quizTagId => $item) {
                    $quizTagIds[] = $quizTagId;
                    QuizTag::findOrFail($quizTagId)->update([
                        'tag_id' => $item['tagId'],
                        'count' => $item['count'] ?? 0,
                        'use_all' => isset($item['use_all']),
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
                        'count' => $item['count'] ?? 0,
                        'use_all' => isset($item['use_all']),
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
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        if (!$this->checkAccess('quizzes', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:1000',
                'topic' => 'required'
            ]);

            $quiz = Quiz::create([
                'name' => $request->input('name'),
                'topic_id' => $request->input('topic'),
                'expertise_area_id' => $request->has('expertiseArea') ? $request->input('expertiseArea') : null
            ]);

            if ($request->has('newQuizTag')) {
                foreach ($request->newQuizTag as $item) {
                    QuizTag::create([
                        'quiz_id' => $quiz->id,
                        'tag_id' => $item['tagId'],
                        'count' => $item['count'] ?? 0,
                        'use_all' => isset($item['use_all']),
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
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function delete($id)
    {
        if (!$this->checkAccess('quizzes', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        Quiz::findOrFail($id)->delete();

        return redirect('/admin/quizzes/list');
    }

}
