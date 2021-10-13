<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HobbiesController extends Controller
{
    public function addHobby(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|between:1,75',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $hobby = UserHobby::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New hobby added to your profile!',
            'hobby' => $hobby,
        ], 201);
    }

    public function removeHobby(Request $request)
    {

        $hobby = UserHobby::find($request->id);

        if ($hobby->user_id == Auth::user()->id) {
            $hobby->delete();

            return response()->json([
                'message' => 'Hobby successfully removed from your profile!',
                'hobby' => $hobby,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot remove a hobby not related to your profile!",
            ], 401);
        }
    }
}
