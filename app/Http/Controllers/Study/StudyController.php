<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    protected string $sectionName = 'study';

    public function index()
    {
        $topics = Topic::all();

        return $this->view('study/index', [
            'topics' => $topics
        ]);
    }
}
