@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-container card">

                    <div class="card-body auth-container-left">

                        <h1>Регистрация</h1>
                        <div class="mb-5">Теперь Ваши объявления и заказы не потеряются и всегда будут доступны</div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('register') }}" class="w-100 mt-3">
                            <div class="form-group row mb-0 justify-content-center">
                                <input type="hidden" name="type" value="2">
                                <button type="submit" class="btn auth-button w-100">
                                    Хочу сдать квартиру
                                </button>
                            </div>
                        </form>

                        <form method="GET" action="{{ route('register') }}" class="w-100 mt-3">
                            <div class="form-group row mb-0 justify-content-center">
                                <input type="hidden" name="type" value="3">
                                <button type="submit" class="btn auth-button w-100">
                                    Хочу снять квартиру
                                </button>
                            </div>
                        </form>

                        <form method="GET" action="{{ route('register') }}" class="w-100 mt-3">
                            <div class="form-group row mb-0 justify-content-center">
                                <input type="hidden" name="type" value="4">
                                <button type="submit" class="btn auth-button w-100">
                                    Хочу предложить свою услугу
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body auth-container-right mt-2">
                        <div class="container">
                            <div>
                                <p><span>Уже зарегестрированы?</span></p>
                            </div>
                            <div class="mt-5 btn-block">
                                <a href="{{ route('login') }}" type="button"
                                   class="btn auth-button">ВОЙТИ</a>
                            </div>

                            <div class="mt-3 text-center">
                                <p><span>Или войти через соцсети</span></p>
                            </div>
                            <div class="socialite-register mt-4 ">
                                <div class="row justify-content-center">
                                    <a href="{{ route('socialite.auth', ['provider' => 'facebook']) }}" class="mr-2 btn btn-light">
                                        <i class="fa fa-2x fa-facebook" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'google']) }}" class="mr-2 btn btn-light">
                                        <i class="fa fa-2x fa-google" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'instagram']) }}" class="mr-2 btn btn-light">
                                        <i class="fa fa-2x fa-instagram" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'telegram']) }}" class="mr-2 btn btn-light">
                                        <i class="fa fa-2x fa-telegram" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
