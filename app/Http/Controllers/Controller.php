<?php

namespace App\Http\Controllers;

use App\Services\Notification\NotificationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected const ITEM_ON_PAGE = 15;
    protected const RESPONSE_STATUS_SUCCESS = 'success';
    protected const RESPONSE_STATUS_ERROR = 'error';

    protected string $sectionName = '';

    protected function view(string $view, array $params = [])
    {
        $params['sectionName'] = $this->sectionName;
        $params['notifications'] = NotificationService::getAllNotifications();

        return view($view, $params);
    }
}
