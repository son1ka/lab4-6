<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel App') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<!-- 1. Компонент Nav -->
<nav class="navbar my-navbar-bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            Семейства черепах
        </a>
        <nav class="navbar my-navbar-bg">
            <form class="container-fluid justify-content-start">
                <a href="{{ route('turtles.create') }}" class="btn btn-outline-success me-2">Добавить</a>
                <button class="btn btn-outline-success me-2" type="button" id="loadButton">Загрузить</button>
            </form>
        </nav>
    </div>
</nav>

<!-- 2. Контейнер для сетки -->
<div class="container mt-4">
    <h1 class="my-4 text">Семейства черепах</h1>
    <div class="row" id="cardsContainer">
        @foreach($turtles as $index => $turtle)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxxl-2 mb-4 card-wrapper"
                 data-bs-toggle="modal"
                 data-bs-target="#detailModal"
                 data-object="{{ $index }}">
                <div class="card h-100">
                    <img src="{{ asset($turtle->image_path) }}" class="card-img-top img-fluid" alt="{{ $turtle->title }}">
                    <div class="overlay-text position-absolute top-0 start-0 m-2 bg-white px-2">Черепаха</div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $turtle->title }}</h5>
                        <p class="card-text flex-grow-1">
                            Латинское название: <strong>{{ $turtle->formatted_latin_name ?? 'Не указано' }}</strong><br>
                            {{ $turtle->description }}
                        </p>
                        <div class="d-flex justify-content-between mt-2">
                            <a href="{{ route('turtles.edit', $turtle->id) }}" class="btn btn-warning btn-sm">Изменить</a>
                            <form action="{{ route('turtles.destroy', $turtle->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- 4. Компонент Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Детали</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalTitle"></h4>
                <p id="modalDescription"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="prevObject" disabled>&larr; Назад</button>
                <button type="button" class="btn btn-primary" id="nextObject">Вперед &rarr;</button>
            </div>
        </div>
    </div>
</div>

<!-- 6. Компонент Toasts -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="loadToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-sync fa-spin me-2"></i>
            <strong class="me-auto">Загрузка</strong>
            <small>Сейчас</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Закрыть"></button>
        </div>
        <div class="toast-body">
            На текущий момент этот функционал недоступен.
        </div>
    </div>
</div>

<!-- Футер -->
<footer class="footer-bg mt-5">
    <div class="container">
        <div class="row align-items-center py-3">
            <div class="col-12 text-center d-flex justify-content-between">
                <p class="mb-0">Титова Софья</p>
                <div>
                    <a href="https://github.com/son1ka">
                        <i class="fab fa-github fa-lg text-dark"></i>
                    </a>
                    <a href="https://messenger.360.yandex.ru/p/da6eb806-5062-9e6a-61e1-b31d850298a7?utm_source=invite">
                        <i class="fas fa-envelope fa-lg text-dark"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    // Метод модели для формирования данных
    window.objectsData = @json($turtles->map->toArrayForModal()->values());
</script>
</body>
</html>
