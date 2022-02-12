<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends AdminController
{
    protected string $sectionName = 'tags';

    public function index()
    {
        return view('admin/tags/list', [
            'sectionName' => $this->sectionName,
            'tags' => Tag::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:100',
            ]);

            Tag::create([
                'name' => $request->input('name')
            ]);
        }

        return redirect('/admin/tags/list');
    }

    public function edit(int $id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:100',
            ]);

            Tag::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'name' => $request->input('name')
                ]);

            return redirect('/admin/tags/list');
        }

        return view('admin/tags/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'tag' => Tag::findOrFail($id),
        ]);
    }

    public function delete($id)
    {
        Tag::findOrFail($id)->delete();

        return redirect('/admin/tags/list');
    }

    public function getJson()
    {
        return json_encode(Tag::all());
    }
}
