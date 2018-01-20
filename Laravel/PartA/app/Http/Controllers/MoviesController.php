<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Requests\MovieFormRequest;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with('cinemas.sessions')->find($id);

        return view('movies.show', compact('movie'));
    }
}
