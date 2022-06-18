<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends AdminController
{
    protected string $sectionName = 'tags';

    public function index()
    {
        if (!$this->checkAccess('tags', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/tags/list', [
            'sectionName' => $this->sectionName,
            'tags' => Tag::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function create(Request $request)
    {
        if (!$this->checkAccess('tags', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

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
        if (!$this->checkAccess('tags', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

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
        if (!$this->checkAccess('tags', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        Tag::findOrFail($id)->delete();

        return redirect('/admin/tags/list');
    }

    public function getJson()
    {
        return json_encode(Tag::all());
    }
}
