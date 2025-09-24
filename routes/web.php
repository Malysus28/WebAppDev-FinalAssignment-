<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\DashboardController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');


Route::middleware('auth')->group(function () {
    // profile 
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// booking attendees 
     Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // orgqniaser 
     Route::get('/organiser/events', [EventController::class, 'manage'])->name('organiser.events.manage');                
    Route::post('/organiser/events', [EventController::class, 'store'])->name('organiser.events.store');
    Route::get('/organiser/events/{event}/edit', [EventController::class, 'edit'])->name('organiser.events.edit');
    Route::put('/organiser/events/{event}', [EventController::class, 'update'])->name('organiser.events.update');
    Route::delete('/organiser/events/{event}', [EventController::class, 'destroy'])->name('organiser.events.destroy');

// Backwards-compatible redirect for old link
Route::get('/events/create', fn () => redirect()->route('organiser.events.manage'))
    ->name('events.create');

});
//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// mybookings page when attendee is logged in 
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [\App\Http\Controllers\BookingController::class, 'index'])
        ->name('bookings.index');
        
// bookings 
    Route::post('/events/{event}/book', [\App\Http\Controllers\BookingController::class, 'store'])
        ->name('bookings.store');
});

require __DIR__.'/auth.php';