@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить новую черепаху</h1>

        <form action="{{ route('turtles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Краткое описание (для карточки)</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="modal_description" class="form-label">Подробное описание (для модального окна)</label>
                <textarea name="modal_description" id="modal_description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="latin_name" class="form-label">Латинское название</label>
                <input type="text" name="latin_name" id="latin_name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <a href="{{ route('turtles.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
