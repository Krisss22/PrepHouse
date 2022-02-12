<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends AdminController
{

    protected string $sectionName = 'statistics';

    public function index()
    {
        return view('admin/statistics/list', [
            'sectionName' => $this->sectionName
        ]);
    }

}
