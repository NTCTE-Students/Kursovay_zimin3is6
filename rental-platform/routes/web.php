<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // маршруты регистрации/входа

Route::view('/home', 'home')
    ->middleware('auth')
    ->name('home');

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::resource('listings', ListingController::class)->middleware('auth');
Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('auth');
Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');
