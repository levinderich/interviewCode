<?php

namespace App\Http\Controllers;

use App\Movie;

class PagesController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function home()
    {
        $movies = Movie::all()->where('featured', 'true');

        return view('home', compact('movies'));
    }
}