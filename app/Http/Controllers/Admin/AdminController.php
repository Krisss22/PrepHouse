<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected const ITEM_ON_PAGE = 15;
    public const ACTION_CREATE = 'create';
    public const ACTION_EDIT = 'edit';

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
