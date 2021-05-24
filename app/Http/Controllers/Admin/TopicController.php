<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends AdminController
{
    protected $sectionName = 'topics';

    public function index()
    {
        return view('admin/topics/list', [
            'sectionName' => $this->sectionName,
            'topics' => Topic::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

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

    public function delete($id)
    {
        Topic::findOrFail($id)->delete();

        return redirect('/admin/topics/list');
    }
}
