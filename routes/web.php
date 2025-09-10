<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
// routes/web.php
Route::get('/', [EventController::class, 'index'])->name('home');
