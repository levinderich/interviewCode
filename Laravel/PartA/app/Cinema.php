<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    public $timestamps = false;

    protected $fillable = ['address'];

    public function movies()
    {
        return $this->belongsToMany('App\Movie','cinema_movie','cinema_id','movie_id');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
