<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view(
            'home',
            [
                'vacancies' => Vacancy::all()
            ]
        );
    }

    public function saveQuestion(Request $request) {
        $data = $request->validate([
            'inputVacancy' => 'required',
            'question' => 'required|max:500'
        ]);

        DB::table('questions_bank')->insert([
            'job_vacancy' => $data['inputVacancy'],
            'question' => $data['question'],
            'answer' => $request->input('answer') ?? ''
        ]);

        return Response::json(['success' => true]);
    }
}
