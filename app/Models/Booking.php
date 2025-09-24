<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // this allows mass assignment for these colums when calling booking::create [], my controller uses create [] so both can be filled 
    protected $fillable = ['user_id', 'event_id'];

    // each booking belongs to one event. this needs a event_id FK col on the bookings table 
    public function event()
    {return $this->belongsTo(Event::class);}
    public function bookings()
{
    return $this->hasMany(\App\Models\Booking::class);
}
}
