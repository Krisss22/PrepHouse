<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Vacancy;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class VacancyController extends AdminController
{
    protected string $sectionName = 'vacancies';

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        if (!$this->checkAccess('vacancies', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/vacancies/list', [
            'sectionName' => $this->sectionName,
            'vacancies' => Vacancy::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function show($id)
    {
        if (!$this->checkAccess('vacancies', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/vacancies/show', [
            'sectionName' => $this->sectionName,
            'vacancy' => Vacancy::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function edit(Request $request, $id)
    {
        if (!$this->checkAccess('vacancies', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'inputName' => 'required|max:100',
            ]);

            Vacancy::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'name' => $request->input('inputName')
                ]);
        }

        return view('admin/vacancies/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'vacancy' => Vacancy::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        if (!$this->checkAccess('vacancies', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'inputName' => 'required|max:100'
            ]);

            Vacancy::query()->insert([
                'name' => $request->input('inputName')
            ]);

            return redirect('/admin/vacancies/list');
        }

        return view('admin/vacancies/edit', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'vacancy' => new Vacancy()
        ]);
    }


    /**
     * @param $id
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function delete($id)
    {
        if (!$this->checkAccess('vacancies', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        Vacancy::findOrFail($id)->delete();

        return redirect('/admin/vacancies/list');
    }
}
