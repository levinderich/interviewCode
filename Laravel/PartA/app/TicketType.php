<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'type';

    protected $fillable = ['price'];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
