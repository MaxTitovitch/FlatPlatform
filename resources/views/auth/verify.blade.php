@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-container card">
                    <div class="card-body auth-container-left">

                        <h1>Подтвердите e-mail</h1>
                        <div class="mb-5">
                            Вам на почту должно было придти письмо верификации. Не пришло? Подтвердите!
                        </div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.
                            </div>
                        @endif

                        <div class="row justify-content-center mb-4">
                            <h4>
                                Письмо не пришло?
                            </h4>
                        </div>

                        <form class="d-inline mt-3" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="form-group row mb-0 justify-content-center">
                                <button type="submit" class="btn auth-button">
                                    ОТПРАВИТЬ ЕЩЁ РАЗ
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body auth-container-right mt-2">
                        <div class="container">
                            <div>
                                <p><span>Выйти из личного кабинета</span></p>
                            </div>
                            <div class="mt-5 btn-block">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" type="button"
                                   class="btn auth-button w-100">ВЫЙТИ</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
