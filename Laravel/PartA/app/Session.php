<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;

    protected $fillable = ['date', 'movie_id', 'cinema_id'];

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    public function cinema()
    {
        return $this->belongsTo('App\Cinema');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
