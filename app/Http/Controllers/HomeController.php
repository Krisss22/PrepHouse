<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveQuestion(Request $request) {
        $data = $request->validate([
            'jobVacancy' => 'required|max:25',
            'question' => 'required|max:500'
        ]);

        DB::table('questions_bank')->insert(['job_vacancy' => $data['jobVacancy'], 'question' => $data['question']]);

        return Response::json(['success' => true]);
    }
}
