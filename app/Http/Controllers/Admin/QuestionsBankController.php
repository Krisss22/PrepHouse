<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuestionsBank;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsBankController extends AdminController
{

    protected $sectionName = 'questions';

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        $questions = QuestionsBank::query();
        $vacanciesList = Vacancy::all();
        $filter = [
            'inputVacancy' => 'empty',
            'inputTags' => '',
            'inputRelease' => 'empty',
            'inputAddedByAdmin' => 'empty'
        ];

        if ($request->input('inputAction') !== 'Clear') {
            if ($request->has('inputVacancy') && $request->input('inputVacancy') !== 'empty') {
                $filter['inputVacancy'] = (int) $request->input('inputVacancy');
                $questions->where('job_vacancy', '=', (int) $request->input('inputVacancy'));
            }
            if ($request->has('inputRelease') && $request->input('inputRelease') !== 'empty') {
                $filter['inputRelease'] = (int) $request->input('inputRelease');
                $questions->where('release', '=', (int) $request->input('inputRelease'));
            }
            if ($request->has('inputAddedByAdmin') && $request->input('inputAddedByAdmin') !== 'empty') {
                $filter['inputAddedByAdmin'] = (int) $request->input('inputAddedByAdmin');
                $questions->where('addedByAdmin', '=', (int) $request->input('inputAddedByAdmin'));
            }
        }

//        var_dump(Auth::check());
//        var_dump(Auth::user()->name);
//        var_dump(\App\Models\User::ADMIN_ROLE);
//        var_dump(Auth::user()->isAdmin());
        return view('admin/questions/list', [
            'sectionName' => $this->sectionName,
            'vacanciesList' => $vacanciesList,
            'filter' => $filter,
            'questions' => $questions->paginate(self::ITEM_ON_PAGE)->appends($filter)
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
                'inputVacancy' => 'required',
                'inputQuestion' => 'required|max:500'
            ]);

            QuestionsBank::query()
                ->where('id', $id)
                ->limit(1)
                ->update([
                    'job_vacancy' => $request->input('inputVacancy'),
                    'question' => $request->input('inputQuestion'),
                    'addedByAdmin' => (int) $request->input('inputAddedByAdmin') ?? 0,
                    'release' => (int) $request->input('inputRelease') ?? 0,
                ]);
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id),
            'vacancies' => Vacancy::all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'inputVacancy' => 'required',
                'inputQuestion' => 'required|max:500'
            ]);

            QuestionsBank::query()->insert([
                'job_vacancy' => $request->input('inputVacancy'),
                'question' => $request->input('inputQuestion')
            ]);

            return redirect('/admin/questions/list');
        }

        return view('admin/questions/edit', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'question' => new QuestionsBank(),
            'vacancies' => Vacancy::all()
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

    public function release($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return view('auth/login');
        }

        QuestionsBank::query()
            ->where('id', $id)
            ->limit(1)
            ->update([
                'release' => 1,
            ]);

        return redirect('/admin/questions/list');
    }
}
