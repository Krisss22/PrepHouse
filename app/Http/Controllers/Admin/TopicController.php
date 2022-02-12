<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends AdminController
{
    protected string $sectionName = 'topics';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin/topics/list', [
            'sectionName' => $this->sectionName,
            'topics' => Topic::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(int $id, Request $request)
    {
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
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
