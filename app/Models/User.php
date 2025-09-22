<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// laravel eloquent model so users can log in 
class User extends Authenticatable
{

    use HasFactory, Notifiable;

        public const TYPE_ORGANISER = 'Organiser';
    public const TYPE_ATTENDEE  = 'Attendee';
//this is so that i can mass assign fields ie user::create (xyz) and only these can be mass assigned
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];
// fields that are hidden in array json format. 
    protected $hidden = [
        'password',
        'remember_token',
    ];
// relationship to other models 
// one to many from users, events using organiser.id as FK
    public function events()
    {
        return $this->hasMany(Event::class, 'organiser_id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'attendee_id');
    }
// this is my role constants and convinience method this also checks the role. 
    public function isOrganiser(): bool
    {
        return $this->type === self::TYPE_ORGANISER;
    }
}
