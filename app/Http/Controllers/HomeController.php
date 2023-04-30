<?php

namespace App\Http\Controllers;

use App\Models\SentQuestion;
use App\Models\Vacancy;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $this->setPageTitle(self::isOriginSite() ? "PrepHouse" : "My Fork - your educational solution");

        return $this->view(
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

    public function shareQuestion(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'title' => 'required',
                'question' => 'required|max:1500',
                'answer' => 'max:1500',
                'email' => 'required|email|max:500',
                'send_feedback' => ''
            ]);

            SentQuestion::create([
                'title' => $data['title'],
                'question' => $data['question'],
                'answer' => $data['answer'] ?? '',
                'email' => $data['email'],
                'send_feedback' => isset($data['send_feedback']) ? 1 : 0,
            ]);

            return redirect('/');
        }

        $titlesColors = [
            'purple',
            'blue',
            'green',
            'orange',
            'yellow',
            'red',
            'rosy',
        ];

        return view('share_question/share_question', [
            'vacancies' => Vacancy::all(),
            'titlesColors' => $titlesColors,
        ]);
    }

}
