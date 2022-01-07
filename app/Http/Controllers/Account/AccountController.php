<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{

    protected string $sectionName = 'account';

    public function index()
    {
        return redirect('account/profile');
    }

    public function profile()
    {
        return view('account/profile', []);
    }

    public function profileSave(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg|max:15360',
                'firstName' => 'required|max:25',
                'surname' => 'required|max:25',
                'jobTitle' => 'max:100',
                'email' => 'required|email',
                'education' => 'max:100',
                'certificates' => 'max:1000',
                'address' => 'max:100',
            ]);

            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = Auth::user()->id . '_' . time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . User::IMAGES_PATH . '/' . Auth::user()->id), $imageName);
            }

            $isUpdated = Auth::user()->update([
                'name' => $request->firstName,
                'surname' => $request->surname,
                'job_title' => $request->jobTitle,
                'education' => $request->education,
                'certificates' => $request->certificates,
                'address' => $request->address,
                'image' => $imageName ?? User::USER_NO_PHOTO_IMAGE_NAME,
            ]);

            if ($isUpdated) {
                return redirect('/account/profile');
            }
        }

        return redirect('/account/profile');
    }

    public function password()
    {
        return view('account/password', []);
    }

    public function passwordSave(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'oldPassword' => 'string',
                'newPassword' => 'string|min:8',
                'confirmNewPassword' => 'string|min:8|same:newPassword',
            ]);

            $errorsArray = [];

            if (!Hash::check($request->oldPassword, Auth::user()->password)) {
                $errorsArray['oldPassword'] = 'Invalid old password!';
            }

            if (count($errorsArray) > 0) {
                return view('account/password')->withErrors($errorsArray);
            }

            $isUpdated = Auth::user()->update([
                'password' => bcrypt($request->newPassword),
            ]);

            if ($isUpdated) {
                return redirect('/account/password');
            }
        }

        return redirect('account/password');
    }

    public function notifications()
    {
        return view('account/notifications', []);
    }

    public function notificationsSave(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->isMethod('post')) {
            $isUpdated = false;

            if ($request->has('news')) {
                $isUpdated = Auth::user()->update([
                    'news' => $request->news
                ]);
            }

            if ($request->has('surveys')) {
                $isUpdated = Auth::user()->update([
                    'surveys' => $request->surveys
                ]);
            }

            if ($request->has('promotions')) {
                $isUpdated = Auth::user()->update([
                    'promotions' => $request->promotions
                ]);
            }

            return Response::json([
                'status' => $isUpdated ? self::RESPONSE_STATUS_SUCCESS : self::RESPONSE_STATUS_ERROR
            ]);
        }

        return Response::json([
            'status' => self::RESPONSE_STATUS_ERROR,
            'errorMessage' => 'Not correct method'
        ]);
    }

}
