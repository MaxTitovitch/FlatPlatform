@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class=" auth-container card">
                    <div class="card-body auth-container-left ">

                        <h1>Войдите в личный кабинет</h1>
                        <div class="mb-5">Получите доступ к диалогам и заказам, а также к редактированию своих
                            объявлений
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" class="ui-form w-100" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group w-100">
                                <div class="input-container w-100">
                                    <div class="form-row w-100">
                                        <input id="username" type="text"
                                               class="w-100 @error('username') is-invalid @enderror" name="username" required
                                               autofocus placeholder="username">
                                        <label for="username">Ваш e-mail или номер телефона</label>
                                    </div>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group w-100">
                                <div class="input-container w-100">
                                    <div class="form-row w-100">
                                        <input id="password" type="password"
                                               class="w-100 @error('password') is-invalid @enderror" name="password"
                                               required autocomplete="current-password" placeholder="password">
                                        <label for="password">Ваш пароль</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <button type="submit" class="btn auth-button">
                                    ВОЙТИ
                                </button>
                                <button type="submit" class="btn auth-button btn-forgot-password">
                                    <a href="{{ route('password.request') }}">ЗАБЫЛИ ПАРОЛЬ? </a>
                                </button>
                            </div>

                            <div class="socialite mt-4 ">
                                <p class=" w-100 text-center mb-3">Или войти через соцсети</p>
                                <div class="row justify-content-center">
                                    <a href="{{ route('socialite.auth', ['provider' => 'facebook']) }}" class="mr-5 btn btn-light">
                                        <i class="fa fa-2x fa-facebook bg-white" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'google']) }}" class=" btn btn-light">
                                        <i class="fa fa-2x fa-google bg-white" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'instagram']) }}" class="ml-5 btn btn-light">
                                        <i class="fa fa-2x fa-instagram bg-white" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('socialite.auth', ['provider' => 'telegram']) }}" class="ml-5 btn btn-light">
                                        <i class="fa fa-2x fa-telegram bg-white" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="card-body auth-container-right mt-2">
                        <div class="container">
                            <div>
                                <p><span>У Вас нет аккаунта?</span></p>
                                <p><span style="font-size: 16px">Он сделает Вашу работу наного удобнее</span></p>
                            </div>
                            <div class="mt-5 btn-block">
                                <a href="{{ route('register') }}" type="button"
                                   class="btn auth-button">ЗАРЕГИСТРИРОВАТЬСЯ</a>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
