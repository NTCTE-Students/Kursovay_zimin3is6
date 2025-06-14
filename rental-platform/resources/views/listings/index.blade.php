@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Объявления</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('listings.create') }}" class="btn btn-primary mb-3">+ Новое объявление</a>

    @foreach($listings as $listing)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $listing->title }}</h4>
                <p>{{ $listing->description }}</p>
                <p><strong>Цена:</strong> {{ $listing->price }} ₽</p>
                <p><small>Автор: {{ $listing->user->name }}</small></p>
                <a href="{{ route('listings.show', $listing) }}" class="btn btn-sm btn-outline-primary">Посмотреть</a>
                @if(auth()->id() === $listing->user_id)
                    <a href="{{ route('listings.edit', $listing) }}" class="btn btn-sm btn-outline-warning">Редактировать</a>
                    <form method="POST" action="{{ route('listings.destroy', $listing) }}" class="d-inline-block" onsubmit="return confirm('Удалить объявление?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
