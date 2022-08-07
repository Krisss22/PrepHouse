<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterviewRequest;

class InterviewRequestController extends Controller
{
    protected string $sectionName = 'interviewRequests';

    public function index()
    {
        return $this->view(
            '/admin/interview-requests/list', [
                'interviewRequests' => InterviewRequest::query()->paginate(self::ITEM_ON_PAGE)
            ]
        );
    }

    public function delete(int $interviewRequestId)
    {
        InterviewRequest::findOrFail($interviewRequestId)->delete();
        return redirect("/admin/interview-requests");
    }

    public function changeStatus(int $interviewRequestId, int $newStatus)
    {
        $interviewRequest = InterviewRequest::findOrFail($interviewRequestId);
        $interviewRequest->update([
            'status' => $newStatus
        ]);

        return redirect("/admin/interview-requests");
    }
}
