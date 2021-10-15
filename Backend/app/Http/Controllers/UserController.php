<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   
    public function getUserInterestedIn()
    {

        return response()->json(User::where([["gender", auth()->user()->interested_in], ["interested_in", auth()->user()->gender]])->with(["previewImages"])->get());
    }

    public function show(User $user)
    {
        // Remove $user->connections() if we don't need to preview his connections
        return response()->json($user->load(["hobbies", "interests", "images"]));
    }

    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'interested_in' => 'required',
            'dob' => 'required|date',
            'height' => 'required',
            'weight' => 'required',
            'nationality' => 'required',
            'city' => 'required',
            'country' => 'required',
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where("id", $id)->update($validator->validated());

        return response()->json([
            'message' => 'profile edited successfully',
            'user' => $user,
        ], 201);
    }

    public function destroy()
    {
        auth()->user()->delete();

        Auth::logout();
        return response()->json([
            'message' => 'Logged out and Deleted account',
        ], 200);
    }
}
