<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function home() {
        return view("App");
    }

    public function show(User $user)
{
        return response()->json($user->load(["location", "books"]));
    }

    public function update(Request $request)

    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where("id", $id)->update($validator->validated());

        return response()->json([
            'message' => 'Profile edited successfully',
            'user' => $user,
        ], 201);
    }

    public function destroy()
    {
        $id = auth()->user()->id;
        User::where("id", $id)->delete();

        Auth::logout();
        return response()->json([
            'message' => 'Logged out and deleted the account',
        ], 200);
    }
}
