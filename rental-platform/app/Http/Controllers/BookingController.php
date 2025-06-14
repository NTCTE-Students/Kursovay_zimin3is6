<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Показать список бронирований текущего пользователя.
     */
    public function index()
    {
        $bookings = Booking::with(['listing', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Сохранить новое бронирование + симулировать оплату.
     */
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'from_date'  => 'required|date|after_or_equal:today',
            'to_date'    => 'required|date|after:from_date',
        ]);

        $listing = Listing::findOrFail($request->listing_id);

        // Запрещаем бронировать своё объявление
        if ($listing->user_id === Auth::id()) {
            return back()->with('error', 'Нельзя бронировать своё объявление.');
        }

        // Создание брони
        $booking = Booking::create([
            'listing_id' => $listing->id,
            'user_id'    => Auth::id(),
            'from_date'  => $request->from_date,
            'to_date'    => $request->to_date,
        ]);

        // Симуляция оплаты
        Payment::create([
            'booking_id' => $booking->id,
            'amount'     => $listing->price,
            'status'     => 'paid',
        ]);
        

        return back()->with('success', 'Бронирование успешно оформлено и оплачено.');
    }
}
