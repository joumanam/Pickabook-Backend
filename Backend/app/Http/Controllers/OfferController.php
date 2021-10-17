<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserTrade;
use App\Models\User;
use App\Models\UserOffer;
use App\Models\UserOfferItems;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{

    public function offer(Request $request)
    {

        $offered_book = AddBook::find($request->book_id);


        // First step: Update Book Status to "Used in offer"

        if ($offered_book) {
            if ($offered_book->status == "Idle") {
                $offered_book->update(["status" => "Used in offer"]);
                $offered_book->update(["price" => Null]);   // since price is only relevant for the buy/sell

                // Second step: Fill table "offers" with the appropriate data

                $trade = UserTrade::find($request->trade_id);
                    $offer = UserOffer::updateOrCreate([         // instead of ::create to avoid duplicate data
                    'user_id' => Auth::user()->id,
                    'trade_id'=> $trade->id
            ]);

                $offered_item = UserOfferItems::updateOrCreate([
                    'offer_id' => $offer->id,
                    'book_id' => $request->book_id
                ]);

                return response()->json([
                    'message' => 'Book successfully put as an offer!',
                    'book' => $offered_book,
                ], 201);

        }
        else {
            return response()->json([
                'message' => "You cannot use this book as an offer. Please check if it's available first!",
            ], 401);
        }


    }else {
        return response()->json([
            'message' => "You cannot use this book as an offer. Please check if it's available first!",
        ], 401);
    }



}}
