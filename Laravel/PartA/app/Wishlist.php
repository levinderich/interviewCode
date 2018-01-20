<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movies()
    {
        return $this->belongsToMany('App\Movie','wishlist_movie','wishlist_id','movie_id');
    }
}
