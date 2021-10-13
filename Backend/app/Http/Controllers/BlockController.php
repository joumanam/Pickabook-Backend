<?php

namespace App\Http\Controllers;

use App\Models\UserBlock;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $block = UserBlock::create(["from_user_id" => auth()->user()->id, "to_user_id" => $id]);

        return response()->json([
            'message' => 'Blocked!',
            'body' => $block,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hobby = UserBlock::find($id);

        if ($hobby->from_user_id == auth()->user()->id) {
            $hobby->delete();

            return response()->json([
                'message' => 'Block successfully removed!',
                'hobby' => $hobby,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot unblock a blocked user not related to your profile!",
            ], 401);
        }
    }
}
