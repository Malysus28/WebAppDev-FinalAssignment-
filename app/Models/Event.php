<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public const CATEGORIES = [
    'Music', 'Food', 'Tech', 'Sports', 'Art', 'Education'
];
    use HasFactory;
    protected $fillable=[
        'organiser_id',
        'title',
        'description',
        'starts_at',
        'location',
        'capacity',
        'categories',
    ];
protected $casts=[
    'starts_at'=>'datetime',
    'categories' => 'array',
];
// reltaionships, event that can belong to an organiser
public function organiser(){
    return $this->belongsTo(User::class,'organiser_id');
}

// relationship, event has many bookings 
public function bookings(){
    return $this->hasMany(Booking::class);
}

//scope for upcoming events
public function scopeUpcoming($query){
    return $query->where('starts_at','>',now())->orderby('starts_at');
}

// test 1 

}