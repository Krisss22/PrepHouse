<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ForkTestController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCredentials(Request $request): JsonResponse
    {
        if (empty($request->input("email")) || empty($request->input("password"))) {
            return response()->json(["success" => false]);
        }

        $account = User::where([
            "email" => $request->input("email"),
        ])->first();

        if (empty($account)) {
            return response()->json(["success" => false]);
        }

        if(Hash::check($request->input("password"), $account->password)) {
            return response()->json(["success" => true]);
        }

        return response()->json(["success" => false]);
    }

}
