<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Services\Notification\NotificationService;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function getAllNotifications(): JsonResponse
    {
        return response()->json(NotificationService::getAllSessionNotificationsAndRemove());
    }
}
