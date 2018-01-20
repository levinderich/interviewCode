<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Cinema;
use App\Admin;
use App\Session;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function admin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $admin = Admin::where('email', $email)->first();

        if ($admin != null && Hash::check($password, $admin->password)) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    // Movies API/CRUD
    public function movies()
    {
        $movies = Movie::all();

        return $movies;
    }

    public function movieCreate(Request $request)
    {
        $movieTitle = $request->get('movie-title');
        $moviePoster = $request->get('movie-poster');
        $movieFeatured = $request->get('movie-featured');

        $movie = new Movie(array('title' => $movieTitle, 'poster' => $moviePoster, 'status' => 'Coming Soon', 'featured' => $movieFeatured));

        $movie->save();

        return 'success';
    }

    public function movieUpdate($id, Request $request)
    {
        $movie = Movie::find($id);
        $movieTitle = $request->get('movie-title');
        $moviePoster = $request->get('movie-poster');
        $movieFeatured = $request->get('movie-featured');

        // Only update new, non null values
        if ($movieTitle != null && $movieTitle != $movie->title) {
            $movie->title = $movieTitle;
        }
        if ($moviePoster != null && $moviePoster != $movie->poster) {
            $movie->poster = $moviePoster;
        }
        if ($movieFeatured != null && $movieFeatured != $movie->featured) {
            $movie->featured = $movieFeatured;
        }

        $movie->save();

        return 'success';
    }

    public function movieDelete($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return 'success';
    }

    public function movieShowSession($id)
    {
        $movie = Movie::with('sessions.cinema')->find($id);

        $cinemas = Cinema::all();

        return compact('movie', 'cinemas');
    }

    // Session API/CRUD
    public function movieCreateSession(Request $request)
    {
        $movieId = $request->get('movie-id');
        $cinemaId = $request->get('cinema-id');
        $date = new \DateTime($request->get('date'));
        $movie = Movie::find($movieId);
        $cinema = Cinema::find($cinemaId);

        $session = new Session(array('movie_id' => $movieId, 'cinema_id' => $cinemaId, 'date' => $date));

        // Coming soon movies become now showing when they get a session
        if ($movie->status == 'Coming Soon') {
            $movie->status = 'Now Showing';
            $movie->save();
        }

        // Movies new to a cinema are added to the cinemas movies
        if (!$cinema->movies->contains($movieId)) {
            $cinema->movies()->attach($movieId);
        }

        $session->save();

        return 'success';
    }

    public function movieUpdateSession($id, Request $request)
    {
        $session = Session::find($id);
        $date = $request->get('date');

        $session->date = new \DateTime($date);

        $session->save();

        return $date;
    }

    public function movieDeleteSession($id)
    {
        $session = Session::find($id);
        $movieId = $session->movie->id;
        $cinemaId = $session->cinema->id;
        $movie = Movie::find($movieId);
        $cinema = Cinema::find($cinemaId);

        $session->delete();

        // Movies with no sessions are coming soon
        if ($movie->sessions->isEmpty()) {
            $movie->status = 'Coming Soon';
            $movie->save();
        }

        // Movies with no session at a cinema deleted from cinemas movies
        if ($movie->sessions->where('cinema_id', $cinemaId)->isEmpty()) {
            $cinema->movies()->detach($movieId);
        }

        return 'success';
    }

    public function bookings()
    {
        $bookings = Booking::with(['tickets.session.movie', 'tickets.session.cinema'])->get();

        return $bookings;
    }
}
