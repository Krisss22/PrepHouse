<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends AdminController
{
    protected string $sectionName = 'vacancies';

    public function index()
    {
        return view('admin/vacancies/list', [
            'sectionName' => $this->sectionName,
            'vacancies' => Vacancy::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function show($id)
    {
        return view('admin/vacancies/show', [
            'sectionName' => $this->sectionName,
            'vacancy' => Vacancy::findOrFail($id)
        ]);
    }

    public function edit(Request $request, $id)
    {
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

    public function create(Request $request)
    {
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


    public function delete($id)
    {
        Vacancy::findOrFail($id)->delete();

        return redirect('/admin/vacancies/list');
    }
}
