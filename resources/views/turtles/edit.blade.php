@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать черепаху</h1>

        <form action="{{ route('turtles.update', $turtle->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $turtle->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Краткое описание</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $turtle->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="modal_description" class="form-label">Подробное описание</label>
                <textarea name="modal_description" id="modal_description" class="form-control" rows="5" required>{{ old('modal_description', $turtle->modal_description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="latin_name" class="form-label">Латинское название</label>
                <input type="text" name="latin_name" id="latin_name" class="form-control" value="{{ old('latin_name', $turtle->latin_name) }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Изображение (оставьте пустым, если не хотите менять)</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Обновить</button>
            <a href="{{ route('turtles.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
