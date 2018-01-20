<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load(['wishlist.movies', 'bookings.tickets.session.movie', 'bookings.tickets.session.cinema']);

        $wishlist = $user->wishlist;
        $bookings = $user->bookings;

        // Coming soon movies that are not in the users wishlist
        $movies = Movie::whereNotIn('id', $wishlist->movies->pluck('id'))->where('status', 'Coming Soon')->get();

        return view('account', compact('bookings', 'wishlist', 'movies'));
    }

    public function wishlistAdd(Request $request)
    {
        $moviesComing = Movie::where('status', "Coming Soon");

        return view('account', compact('moviesComing'));
    }

    public function wishlistStore(Request $request)
    {
        $movie = $request->get('movie');
        $wishlist = Auth::user()->wishlist;

        // Don't add movie more than once
        if ($wishlist->movies->contains($movie)) {
            return redirect('account');
        } else {
            $wishlist->movies()->attach($request->get('movie'));
            return redirect('account');
        }
    }

    public function wishlistDelete(Request $request)
    {
        $movieId = $request->get('movie-id');

        Auth::user()->wishlist->movies()->detach($movieId);

        return redirect('account');
    }
}
