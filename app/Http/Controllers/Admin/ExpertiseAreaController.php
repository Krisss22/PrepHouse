<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExpertiseArea;
use App\Models\Role;
use Illuminate\Http\Request;

class ExpertiseAreaController extends AdminController
{
    protected string $sectionName = 'expertise-areas';

    public function index()
    {
        if (!$this->checkAccess('expertise_areas', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return $this->view('admin/expertise-areas/list', [
            'expertiseAreas' => ExpertiseArea::query()->paginate(self::ITEM_ON_PAGE)
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

            ExpertiseArea::create([
                'name' => $request->input('name')
            ]);
        }

        return redirect('/admin/expertise-areas/list');
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

            ExpertiseArea::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'name' => $request->input('name'),
                    'active' => $request->has('active')
                ]);

            return redirect('/admin/expertise-areas/list');
        }

        return $this->view('admin/expertise-areas/edit', [
            'action' => self::ACTION_EDIT,
            'expertiseArea' => ExpertiseArea::findOrFail($id),
        ]);
    }

    public function delete(int $id)
    {
        ExpertiseArea::findOrFail($id)->delete();
        return redirect("/admin/expertise-areas/list");
    }

    public function changeStatus(int $expertiseAreaId, bool $newStatus)
    {
        $expertiseArea = ExpertiseArea::findOrFail($expertiseAreaId);
        $expertiseArea->update([
            'active' => $newStatus
        ]);

        return redirect("/admin/expertise-areas/list");
    }

    public function getJson()
    {
        return json_encode(ExpertiseArea::all());
    }
}
