<?php

namespace App\Http\Controllers;

use App\Models\UserPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PictureController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if ($request->hasFile('file')) {

            $profile_picture = 0;
            if ($request->has("is_profile_picture")) {
                $profile_picture = 1;
            }

            $image = $request->file('file');
            $name = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);

            $userPicture = new UserPicture();
            $userPicture->user_id = auth()->user()->id;
            $userPicture->picture_url = $name;
            $userPicture->is_profile_picture = $profile_picture;
            $userPicture->save();

            return response()->json([
                'message' => "Uploaded Successfully!",
                'url' => $name,
            ], 201);
        }

        return response()->json([
            'message' => "Couldn't Upload Image",
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPicture  $userPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = UserPicture::find($id);

        if ($image->user_id == auth()->user()->id) {
            unlink(public_path('/images/') . $image->picture_url);
            $image->delete();

            return response()->json([
                'message' => 'Removed image',
            ], 201);
        } else {
            return response()->json([
                'message' => "You cannot delete the image",
            ], 401);
        }
    }
}
