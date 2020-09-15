@extends('layouts.app')

@section('content')
<div class="container mb-3 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class=" auth-container card">
                <div class="card-body auth-container-left ">

                    <h1>Забыли пароль?</h1>
                    <div class="mb-5">Инструкция по восстановлению пароля <br> будет отправлена на Ваш e-mail </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Мы отправили вам ссылку для сброса пароля по электронной почте!
                        </div>
                    @endif

                    <form method="POST" class="ui-form w-100" action="{{ route('password.email') }}" >
                        @csrf

                        <div class="form-group w-100">
                            <div class="input-container w-100">
                                <div class="form-row w-100">
                                    <input id="email" type="email" class="w-100 @error('email') is-invalid @enderror" name="email" placeholder="email" required autocomplete="email" autofocus>
                                    <label for="email">Email</label>
                                </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Введите корректный адресс электронной почты</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                                <button type="submit" class="btn auth-button auth-button-reset-password">
                                    СБРОСИТЬ ПАРОЛЬ
                                </button>
                        </div>
                    </form>
                </div>

                <div class="card-body auth-container-right mt-2">
                    <div>
                        <span>Вспомнили пароль?</span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" type="button" class="btn  auth-button ">ВОЙТИ</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
