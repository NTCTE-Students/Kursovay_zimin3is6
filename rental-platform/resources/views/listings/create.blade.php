@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создать объявление</h1>

    <form method="POST" action="{{ route('listings.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена (₽)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <button class="btn btn-success">Сохранить</button>
        <a href="{{ route('listings.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
