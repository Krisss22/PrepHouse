<?php

namespace App\Http\Controllers\Strategies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrategiesController extends Controller
{
    protected string $sectionName = 'strategies';

    public function index()
    {
        return $this->view('strategies/index');
    }
}
