<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;

    protected $fillable = ['type', 'amount', 'booking_id', 'session_id'];

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }

    public function type()
    {
        return $this->belongsTo('App\TicketType', 'type');
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session');
    }
}
