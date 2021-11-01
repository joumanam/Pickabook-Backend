<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ShowAddBookController extends Controller
{

    public function addBooks(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|between:1,100',
            'author' => 'required|string|between:1,100',
            'image_url' => 'required|string|between:1,200',
            'category' => 'required|string|between:1,100',
            'language' => 'required|string|between:1,100',
            'condition' => 'required|string|between:1,100',
            'price' => 'required|string|between:1,100',
            'rating' => 'required|string|between:1,100',
            'status' => 'required|string|between:1,100'


        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $add_book = AddBook::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New book added to your listing!',
            'book' => $add_book], 201);

    }

    function showBooks(Request $request) {
        // $show_books = AddBook::all()->where("user_id", "=", auth()->user()->id);
        $show_books = AddBook::all()->where("user_id", "=", $request->id);

        return json_encode($show_books);
    }

    function showAllBooks() {

        $show_all_books = AddBook::all();
        return json_encode($show_all_books);
    }

    public function removeBooks($id)
    {

        $remove_book = AddBook::find($id);


        if ($remove_book->user_id == auth()->user()->id) {
            $remove_book->delete();

            return response()->json([
                'message' => 'Book successfully removed from your listing!',
                'book' => $remove_book,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot remove a book not related to your profile!",
            ], 401);
        }
    }


    public function tradeBooks($id)
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

    public function getUser(Request $request)
    {
        $userProfile = User::all()->where("id", "=", $request->id);
        return $userProfile;
    }
}
