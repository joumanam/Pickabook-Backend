<?php

namespace App\Http\Controllers;

use App\Models\UserConnection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // Update response to 1 if the logged in user have been matched by the other user
        $connected = UserConnection::where('user2_id', auth()->user()->id)
            ->where('user1_id', $id)
            ->update(["response" => 1]);

        if (!$connected) {
            // Create the connection if both of them haven't previously matched other
            $match = UserConnection::create(["user1_id" => auth()->user()->id, "user2_id" => $id]);
        } else {
            $match = "Connected Togather!";
        }

        return response()->json([
            'message' => 'Mathced!!!',
            'body' => $match,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserConnection  $userConnection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $connection = UserConnection::find($id);
        if (auth()->user()->id == $connection->user1_id || auth()->user()->id == $connection->user2_id) {
            $connection->delete();

            return response()->json([
                'message' => 'Unmatched',
            ], 200);
        } else {

            return response()->json([
                'message' => "You cannot unmatch someone not related to you!",
            ], 401);
        }

    }
}
