@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать объявление</h1>

    <form method="POST" action="{{ route('listings.update', $listing) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" value="{{ $listing->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $listing->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена (₽)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $listing->price }}" required>
        </div>

        <button class="btn btn-success">Обновить</button>
        <a href="{{ route('listings.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
