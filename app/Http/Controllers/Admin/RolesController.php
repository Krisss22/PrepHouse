<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RolesController extends AdminController
{
    protected string $sectionName = 'roles';

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return $this->view('admin/roles/list', [
            'roles' => Role::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param int $roleId
     * @return Application|Factory|View
     */
    public function show(int $roleId)
    {
        return $this->view('admin/roles/show', [
            'role' => Role::findOrFail($roleId),
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                "name" => "required|max:1000"
            ]);

            Role::create($this->getInputsFromRequest($request));

            return redirect("/admin/roles/list");
        }

        return $this->view('admin/roles/edit', [
            'action' => self::ACTION_CREATE,
            'role' => new Role(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $roleId
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(Request $request, int $roleId)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                "name" => "required|max:1000"
            ]);

            Role::findOrFail($roleId)->update($this->getInputsFromRequest($request));

            return redirect("/admin/roles/list");
        }

        return $this->view('admin/roles/edit', [
            'action' => self::ACTION_EDIT,
            'role' => Role::findOrFail($roleId),
        ]);
    }

    /**
     * @param $roleId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($roleId)
    {
        Role::findOrFail($roleId)->delete();

        return redirect('/admin/roles/list');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getInputsFromRequest(Request $request): array
    {
        return [
            "name" => $request->input("name"),
            "roles_permissions" => $request->input("roles_permissions"),
            "users_permissions" => $request->input("users_permissions"),
            "topics_permissions" => $request->input("topics_permissions"),
            "tags_permissions" => $request->input("tags_permissions"),
            "questions_permissions" => $request->input("questions_permissions"),
            "quizzes_permissions" => $request->input("quizzes_permissions"),
            "study_books_permissions" => $request->input("study_books_permissions"),
            "study_materials_permissions" => $request->input("study_materials_permissions"),
            "study_videos_permissions" => $request->input("study_videos_permissions"),
            "study_sites_permissions" => $request->input("study_sites_permissions"),
            "vacancies_permissions" => $request->input("vacancies_permissions"),
            "sent_questions_permissions" => $request->input("sent_questions_permissions"),
        ];
    }
}
