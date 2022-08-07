<?php

namespace App\Http\Controllers\InterviewRequest;

use App\Http\Controllers\Controller;
use App\Models\InterviewRequest;
use App\Services\Notification\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewRequestController extends Controller
{
    public function saveInterviewRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'text' => 'required|string',
        ]);

        InterviewRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'text' => $validated['text'],
            'status' => InterviewRequest::STATUS_CREATED,
            'user_id' => Auth::check() ? Auth::user()->id : null,
        ]);

        NotificationService::addSessionNotification('Your interview request received');

        return redirect('landing/preparation-for-interviews');
    }
}
