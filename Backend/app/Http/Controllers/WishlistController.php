<?php

namespace App\Http\Controllers;

use App\Models\UserWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{

    public function addWishlist(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|between:1,100',
            'author' => 'required|string|between:1,100',

        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $wishlist = UserWishlist::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New book added to your wishlist!',
            'wishlist' => $wishlist ], 201);

    }

    function showWishlist() {
        $showWishlist = UserWishlist::all()->where("user_id", "=", auth()->user()->id);
        return json_encode($showWishlist);
    }

    public function removeBooks(Request $request)
    {

        $removeWishlist = UserWishlist::find($request->id);


        if ($removeWishlist->user_id == Auth::user()->id) {
            $removeWishlist->delete();

            return response()->json([
                'message' => 'Book successfully removed from your wishlist!',
                'wishlist' => $removeWishlist,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot remove a book that is already not in your wishlist!",
            ], 401);
        }
    }

}
