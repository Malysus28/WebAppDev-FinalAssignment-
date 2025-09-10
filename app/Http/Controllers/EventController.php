<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $events=Event::with('organiser')
        ->withCount('bookings')
        ->upcoming()
        ->paginate(8);
        return view('events.index',compact('events'));
    }
    public function show (Event $event){
        $event->load('organiser','bookings');
        return view('events.show',compact('event'));
    }
}
