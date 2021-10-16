<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{

// Put your book up for trade

    public function trade($id)
    {
        $trade_book = AddBook::find($id);

        // $trade_book = AddBook::where("user_id", auth()->user()->id)
        // ->where("id", $book_id)

        if ($trade_book) {
            if ($trade_book->status == "Idle") {
                $trade_book->update(["status" => "For Trade"]);

            return response()->json([
                'message' => 'Book successfully put up for trade!',
                'book' => $trade_book,
                ], 201);
        }
    }
        else {
        return response()->json([
            'message' => "Please check if the book is available for trade first. (Status must be 'Idle')",
        ], 401);

        }}

// Put your book up for sale

    public function sale($id)
    {
        $sell_book = AddBook::find($id);

        if ($sell_book) {
            if ($sell_book->status == "Idle") {
                $sell_book->update(["status" => "For Sale"]);

            return response()->json([
                'message' => 'Book successfully put up for sale!',
                'book' => $sell_book,
                ], 201);
        }
    }
        else {
        return response()->json([
            'message' => "Please check if the book is available for selling first. (Status must be 'Idle')",
        ], 401);

        }}

// Put your book up for auction

    public function auction($id)
        {
            $auction_book = AddBook::find($id);

            if ($auction_book) {
                if ($auction_book->status == "Idle") {
                    $auction_book->update(["status" => "For Auction"]);

                return response()->json([
                    'message' => 'Book successfully put up for auction!',
                    'book' => $auction_book,
                    ], 201);
            }
        }
            else {
            return response()->json([
                'message' => "Please check if the book is available for selling first. (Status must be 'Idle')",
            ], 401);

            }}

// Updating Price when book is for sale

public function updateprice(Request $request)
{

    $validator = Validator::make($request->all(), [
        'price' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors()->toJson(), 400);
    }

    $price = AddBook::where("id", $request->id)->where("status", "For Sale")->update($validator->validated());
    if ($price) {
        return response()->json([
            'message' => 'Price updated successfully',
            'user' => $price,
        ], 201);
    }else{
        return response()->json([
            'message' => "Price cannot be updated. Please check if it's up for sale first.",
        ], 401);
    }
}
}
