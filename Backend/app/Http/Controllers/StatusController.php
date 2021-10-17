<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserTrade;


class StatusController extends Controller
{

// Put your book up for trade

    public function trade($id)
    {
        $trade_book = AddBook::find($id);

        // $trade_book = AddBook::where("user_id", auth()->user()->id)
        // ->where("id", $book_id)

        // First step: Update Book Status

        if ($trade_book) {
            if ($trade_book->status == "Idle") {
                $trade_book->update(["status" => "For Trade"]);
                $trade_book->update(["price" => Null]);   // since price is only relevant for the buy/sell

                // Second step: Any new book for trade should be added to the trades table
                $books = AddBook::get()->where("status", "For Trade");
                foreach ($books as $key => $value) {

                    UserTrade::updateOrCreate([         // instead of ::create to avoid duplicate data
                    'user_id' => $value->user_id,
                    'book_id'=> $value->id
            ]);
        }

            return response()->json([
                'message' => 'Book successfully put up for trade!',
                'book' => $trade_book,
                ], 201);
        }

        else {
        return response()->json([
            'message' => "Please check if the book is available for trade first. (Status must be 'Idle')",
        ], 401);

        }
    }
        // Second Step: All books for trade should be added to the trades table



    }

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

        else {
        return response()->json([
            'message' => "Please check if the book is available for selling first. (Status must be 'Idle')",
        ], 401);

        }}
    }

// Put your book up for auction

    public function auction($id)
        {
            $auction_book = AddBook::find($id);

            if ($auction_book) {
                if ($auction_book->status == "Idle") {
                    $auction_book->update(["status" => "For Auction"]);
                    $auction_book->update(["price" => Null]);   // since price is only relevant for the buy/sell


                return response()->json([
                    'message' => 'Book successfully put up for auction!',
                    'book' => $auction_book,
                    ], 201);
            }

            else {
            return response()->json([
                'message' => "Please check if the book is available for selling first. (Status must be 'Idle')",
            ], 401);

            }}
        }

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

// Return to Idle status

public function idle($id)
{
    $idle = AddBook::find($id);

    if ($idle) {
        if ($idle->status == "For Trade") {
           UserTrade::where("book_id", $id)->delete();
           $idle->update(["status" => "Idle"]);

        return response()->json([
        'message' => 'Book successfully returned to Idle status!',
        'book' => $idle,
        ], 201);
        }

        if ($idle->status != "Idle") {
            $idle->update(["status" => "Idle"]);
            $idle->update(["price" => Null]);   // since price is only relevant for the buy/sell


        return response()->json([
            'message' => 'Book successfully returned to Idle status!',
            'book' => $idle,
            ], 201);
    }

    else {
    return response()->json([
        'message' => "Book already in Idle status!",
    ], 401);

    }}
}
}
