<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddBook;

class SearchController extends Controller
{

    // Filtering by title

    public function title($string)
    {
        $result = AddBook::where("title", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return json_encode($result);
        } else {
            return response()->json([
                'message' => "No records found.",
            ], 401);
        }
    }

    // Filtering by author


    public function author($string)
    {
        $result = AddBook::where("author", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return json_encode($result);
        } else {
            return response()->json([
                'message' => "No records found.",
            ], 401);
        }
    }

    // Filtering by language


    public function language($string)
    {
        $result = AddBook::where("language", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return json_encode($result);
        } else {
            return response()->json([
                'message' => "No records found.",
            ], 401);
        }
    }

    // Filtering by status

    public function status($string)
    {
        $result = AddBook::where("status", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return json_encode($result);
        } else {
            return response()->json([
                'message' => "No records found.",
            ], 401);
        }
    }
}

