<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param string $sector
     * @param string|null $accessType
     * @return bool
     */
    public function checkAccess(string $sector, string $accessType = null): bool
    {
        if (Auth::guest()) {
            return false;
        }

        return Auth::user()->userRole->checkAccess($sector, $accessType);
    }
}
