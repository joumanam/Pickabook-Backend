<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ShowAddBookController extends Controller
{
    function homepage() {
        return view("welcome");
    }

    public function addBooks(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|between:1,100',
            'author' => 'required|string|between:1,100',
            'image_url' => 'required|string|between:1,200',
            'genre' => 'required|string|between:1,100',
            'language' => 'required|string|between:1,100',
            'condition' => 'required|string|between:1,100',
            'price' => 'required|string|between:1,100',
            'rating' => 'required|string|between:1,100',

        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $add_book = AddBook::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New book added to your listing!',
            'book' => $add_book], 201);

    }

    function showBooks() {
        $show_books = AddBook::all()->where("user_id", "=", auth()->user()->id);
        return json_encode($show_books);
    }

    public function removeBooks(Request $request)
    {

        $remove_book = AddBook::find($request->id);

        
        if ($remove_book->user_id == Auth::user()->id) {
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

}
