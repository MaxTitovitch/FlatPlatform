@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/error-style.css') }}"/>
@endsection

@section('content')
    <div class="error-main">
        <h1>Страница не найдена</h1>
        <p>
            Возможно эта страница была удалена,<br> или допущена ошибка в адресе.
        </p>
        <p>
            Перейдите на интерисующий вас раздел
        </p>
        <a href="{{ route('index') }}">ВЕРНУТЬСЯ НА ГЛАВНУЮ</a>
    </div>
@endsection
