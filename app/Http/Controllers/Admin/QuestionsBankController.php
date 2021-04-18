<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuestionsBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionsBankController extends AdminController
{

    protected const ITEM_ON_PAGE = 15;

    protected $sectionName = 'questions';

    public function index()
    {
        if (!Auth::check()) {
            return view('auth/login');
        }
//        var_dump(Auth::check());
//        var_dump(Auth::user()->name);
//        var_dump(\App\Models\User::ADMIN_ROLE);
        return view('admin/questions/list', [
            'sectionName' => $this->sectionName,
            'questions' => DB::table('questions_bank')->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    public function show($id)
    {
        if (!Auth::check()) {
            return view('auth/login');
        }

        return view('admin/questions/show', [
            'sectionName' => $this->sectionName,
            'question' => QuestionsBank::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        if (!Auth::check()) {
            return view('auth/login');
        }

        QuestionsBank::findOrFail($id)->delete();

        return redirect('/admin/questions/list');
    }
}
