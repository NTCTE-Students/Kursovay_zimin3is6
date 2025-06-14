@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $listing->title }}</h1>

    <p>{{ $listing->description }}</p>
    <p><strong>Цена:</strong> {{ $listing->price }} ₽</p>
    <p><strong>Автор:</strong> {{ $listing->user->name }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(auth()->id() !== $listing->user_id)
    <h4>Забронировать</h4>
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <input type="hidden" name="listing_id" value="{{ $listing->id }}">

        <div class="mb-3">
            <label class="form-label">Дата начала</label>
            <input type="date" name="from_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата конца</label>
            <input type="date" name="to_date" class="form-control" required>
        </div>

        <button class="btn btn-primary">Забронировать и оплатить</button>
    </form>
    @endif

    <a href="{{ route('listings.index') }}" class="btn btn-link mt-3">← Назад</a>
</div>
@endsection
