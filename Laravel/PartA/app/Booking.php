<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
