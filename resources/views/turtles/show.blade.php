@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $turtle->title }}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($turtle->image_path) }}" class="img-fluid" alt="{{ $turtle->title }}">
            </div>
            <div class="col-md-6">
                <h3>Латинское название:</h3>
                <p>{{ $turtle->latin_name ?? 'Не указано' }}</p>

                <h3>Описание:</h3>
                <p>{{ $turtle->modal_description }}</p>

                <a href="{{ route('turtles.edit', $turtle->id) }}" class="btn btn-warning">Редактировать</a>
                <form action="{{ route('turtles.destroy', $turtle->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить {{ addslashes($turtle->title) }}?')">Уд.</button>
                </form>
                <a href="{{ route('turtles.index') }}" class="btn btn-secondary">Назад к списку</a>
            </div>
        </div>
    </div>
@endsection
