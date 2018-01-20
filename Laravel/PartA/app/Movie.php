<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'poster', 'status', 'featured'];

    public function cinemas()
    {
        return $this->belongsToMany('App\Cinema');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\Wishlist');
    }
}
