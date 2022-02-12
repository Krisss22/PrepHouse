<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends AdminController
{

    protected string $sectionName = 'common';

    public function index()
    {
        return view('admin/common/list', [
            'sectionName' => $this->sectionName
        ]);
    }
}
