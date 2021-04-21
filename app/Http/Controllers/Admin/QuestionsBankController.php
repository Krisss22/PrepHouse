<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuestionsBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsBankController extends AdminController
{

    protected $sectionName = 'questions';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }
//        var_dump(Auth::check());
//        var_dump(Auth::user()->name);
//        var_dump(\App\Models\User::ADMIN_ROLE);
//        var_dump(Auth::user()->isAdmin());
        return view('admin/questions/list', [
            'sectionName' => $this->sectionName,
            'questions' => QuestionsBank::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        return view('admin/questions/show', [
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'inputJobVacancy' => 'required|max:25',
                'inputQuestion' => 'required|max:500'
            ]);

            QuestionsBank::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'job_vacancy' => $request->input('inputJobVacancy'),
                    'question' => $request->input('inputQuestion'),
            ]);
        }

        return view('admin/questions/edit', [
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        QuestionsBank::findOrFail($id)->delete();

        return redirect('/admin/questions/list');
    }
}
