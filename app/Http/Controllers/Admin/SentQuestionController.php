<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SentQuestion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SentQuestionController extends AdminController
{

    protected string $sectionName = 'sent-questions';

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        if (!$this->checkAccess('sent_questions', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/sent-question/list', [
            'sectionName' => $this->sectionName,
            'sentQuestions' => SentQuestion::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function show($id)
    {
        if (!$this->checkAccess('sent_questions', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/sent-question/show', [
            'sectionName' => $this->sectionName,
            'sentQuestion' => SentQuestion::findOrFail($id)
        ]);
    }

    /**
     * @param $id
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function delete($id)
    {
        if (!$this->checkAccess('sent_questions', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        SentQuestion::findOrFail($id)->delete();

        return redirect('/admin/sent-questions/list');
    }

}
