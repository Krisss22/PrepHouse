<?php

namespace App\Http\Controllers\Admin;

use App\Models\Landing;
use Illuminate\Http\Request;

class LandingsController extends AdminController
{
    const CONDITION_ENABLED = "enable";
    const CONDITION_DISABLED = "disable";

    protected string $sectionName = 'landings';

    public function index()
    {
        return $this->view('admin/landings/list', [
            'landings' => Landing::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                "name" => "required|max:1000"
            ]);

            Landing::create([
                'name' => $request->input('name')
            ]);

            return redirect("/admin/landings/list");
        }
    }

    public function edit(Request $request, int $landingId)
    {
        $landing = Landing::findOrFail($landingId);

        if ($request->isMethod('POST')) {
            $request->validate([
                "name" => "required|max:1000"
            ]);

            $landing->update([
                'name' => $request->input('name'),
                'active' => $request->has('active'),
            ]);

            return redirect("/admin/landings/list");
        }

        return $this->view('admin/landings/edit', [
            'landing' => $landing
        ]);
    }

    public function delete(int $landingId)
    {
        Landing::findOrFail($landingId)->delete();

        return redirect("/admin/landings/list");
    }

    public function changeActive(int $landingId, string $condition)
    {
        Landing::findOrFail($landingId)->update(["active" => $condition === self::CONDITION_ENABLED ? 1 : 0]);

        return redirect("/admin/landings/list");
    }
}
