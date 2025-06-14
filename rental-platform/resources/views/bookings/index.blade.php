@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мои бронирования</h1>

    @foreach($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $booking->listing->title }}</h5>
                <p><strong>С:</strong> {{ $booking->from_date }} &nbsp; <strong>До:</strong> {{ $booking->to_date }}</p>
                <p><strong>Оплата:</strong> {{ $booking->payment->amount }} ₽ — {{ $booking->payment->status }}</p>
            </div>
        </div>
    @endforeach

    @if($bookings->isEmpty())
        <p>У вас пока нет бронирований.</p>
    @endif
</div>
@endsection
