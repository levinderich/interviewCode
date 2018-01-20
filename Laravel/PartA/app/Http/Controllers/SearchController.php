<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class SearchController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('search', compact('movies'));
    }

    public function search(Request $request)
    {
        $movies = null;
        $search = $request->get('searchMovie');
        $searchType = $request->get('searchType');

        // Find movies with title like search term
        if ($searchType == 'sMovie') {
            $movies = Movie::where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            })->orderBy('status', 'desc')->get();
        }

        // Find movies at cinema with addres like search term
        if ($searchType == 'sCinema') {
            $movies = Movie::whereHas('cinemas', function ($query) use ($search) {
                $query->where('address', 'like', "%$search%");
            })->orderBy('status', 'desc')->get();
        }

        return view('search', compact('movies'));
    }
}
