<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;

Auth::routes(); // маршруты регистрации/входа

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::resource('listings', ListingController::class)->middleware('auth');
Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('auth');
Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');
