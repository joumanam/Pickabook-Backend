<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddBook;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    // Filtering by title

    public function title($string)
    {
        $result = AddBook::where("title", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return $result;
        } else {
            return array('No records found');
        }
    }

    // Filtering by author


    public function author($string)
    {
        $result = AddBook::where("author", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return $result;
        } else {
            return array('No records found');
        }
    }

    // Filtering by language


    public function language($string)
    {
        $result = AddBook::where("language", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return $result;
        } else {
            return array('No records found');
        }
    }

    // Filtering by status

    public function status($string)
    {
        $result = AddBook::where("status", 'LIKE', '%' . $string . '%')->get();
        if(count($result)){
            return $result;
        } else {
            return array('No records found');
        }
    }
}

