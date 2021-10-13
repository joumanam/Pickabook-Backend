<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserInfoController extends Controller
{
    public function addInfo(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'country' => 'required|string|between:1,100',
            'city' => 'required|string|between:1,100',


        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $info = UserInfo::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New info added to your profile!',
            'info' => $info], 201);

    }

    public function removeInfo($id)
    {

        $info = UserInfo::find($id);

        if ($info->user_id == Auth::user()->id) {
            $info->delete();

            return response()->json([
                'message' => 'info successfully removed from your profile!',
                'info' => $info,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot remove an info not related to your profile!",
            ], 401);
        }

    }

}
