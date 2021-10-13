<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use App\Models\UserPicture;

class AdminController extends Controller
{
    public function getImagesForApproveQueue()
    {
        return response()->json(UserPicture::oldest()->where("is_approved", 0)->with(["user"])->get(), 200);
    }

    public function approveImage($id)
    {
        $image = UserPicture::where("id", $id)->update(["is_approved" => 1]);

        if ($image) {
            return response()->json([
                'message' => 'Approved',
                'code' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => "Couldn't Approve Image",
            ], 400);
        }
    }

    public function declineImage($id)
    {
        $image = UserPicture::where("id", $id)->update(["is_approved" => -1]);

        if ($image) {
            return response()->json([
                'message' => 'Declined',
                'code' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => "Couldn't Decline Image",
            ], 400);
        }
    }

    public function getMessagesForApproveQueue()
    {
        return response()->json(UserMessage::oldest()->where("is_approved", 0)->with(["fromUser", "toUser"])->get(), 200);
    }

    public function approveMessage($id)
    {
        $message = UserMessage::where("id", $id)->update(["is_approved" => 1]);

        if ($message) {
            return response()->json([
                'message' => 'Approved',
                'code' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => "Couldn't Approve Message",
            ], 400);
        }
    }

    public function declineMessage($id)
    {
        $message = UserMessage::where("id", $id)->update(["is_approved" => -1]);

        if ($message) {
            return response()->json([
                'message' => 'Decline',
                'code' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => "Couldn't Decline Message",
            ], 400);
        }
    }
}
