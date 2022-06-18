<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TopicController extends AdminController
{
    protected string $sectionName = 'topics';

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        if (!$this->checkAccess('topics', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/topics/list', [
            'sectionName' => $this->sectionName,
            'topics' => Topic::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        if (!$this->checkAccess('topics', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:100',
            ]);

            Topic::create([
                'name' => $request->input('name')
            ]);
        }

        return redirect('/admin/topics/list');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function edit(int $id, Request $request)
    {
        if (!$this->checkAccess('topics', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:100',
            ]);

            Topic::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'name' => $request->input('name')
                ]);

            return redirect('/admin/topics/list');
        }

        return view('admin/topics/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'topic' => Topic::findOrFail($id),
        ]);
    }

    /**
     * @param $id
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function delete($id)
    {
        if (!$this->checkAccess('topics', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        Topic::findOrFail($id)->delete();

        return redirect('/admin/topics/list');
    }

    /**
     * @return false|string
     */
    public function getJson()
    {
        return json_encode(Topic::all());
    }
}
