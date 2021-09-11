<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{

    public function index()
    {
//        dd(123);
        return view('quiz/list', [
        ]);
    }
}
