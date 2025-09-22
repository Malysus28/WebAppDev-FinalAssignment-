<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // POST /events/{event}/book
    public function store(Request $request, Event $event)
    {$user = $request->user();
        // Only Attendees can book
        if ($user->type !== \App\Models\User::TYPE_ATTENDEE) {
            return back()->with('error', 'Only attendees can book events.');}

        // Event must be upcoming
        if ($event->starts_at->isPast()) {
            return back()->with('error', 'You cannot book a past event.');}

        // max cap check 
        $current = $event->bookings()->count();
        if ($current >= (int) $event->capacity) {
            return back()->with('error', 'This event is full.');}

        // no double booking because it said so 
        $already = Booking::where('event_id', $event->id)
                          ->where('user_id', $user->id)
                          ->exists();
        if ($already) {
            return back()->with('error', 'You have already booked this event.');}

        // create,make booking 
        Booking::create([
            'event_id' => $event->id,
            'user_id'  => $user->id,
        ]);

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Booking confirmed!');}

    // GET /my-bookings
 public function index(\Illuminate\Http\Request $request)
{
    // All bookings for the logged-in attendee, sorted by event date
    $bookings = \App\Models\Booking::with(['event' => function ($q) {
            $q->select('id', 'title', 'starts_at', 'location'); // only needed fields
        }])
        ->where('user_id', $request->user()->id)
        ->join('events', 'bookings.event_id', '=', 'events.id')
        ->orderBy('events.starts_at', 'asc')
        ->select('bookings.*') 
        ->get();

    return view('events.my-bookings', compact('bookings'));
}
    // DELETE /bookings/{booking}
    public function destroy(Request $request, Booking $booking)
    {
        if ($booking->user_id !== $request->user()->id) {
            abort(403);
        } $booking->delete();
        return back()->with('success', 'Booking cancelled.');
    }
}
