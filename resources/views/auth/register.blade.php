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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group w-100">
                                <div class="input-container w-100">

                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="last_name" type="text"
                                                       class="w-100  @error('last_name') is-invalid @enderror"
                                                       name="last_name"
                                                       required placeholder="фамилия"
                                                       value="{{ old('last_name') }}">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="last_name">Ваш фамилия</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="name" type="text"
                                                       class="w-100 @error('name') is-invalid @enderror" name="name"
                                                       required placeholder="name"
                                                       value="{{ old('name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="name">Ваше имя</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="email" type="text"
                                                       class="w-100 @error('email') is-invalid @enderror" name="email"
                                                       required placeholder="email"
                                                       value="{{ old('email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="email">Ваше e-mail</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="phone" type="text"
                                                       class="w-100 @error('phone') is-invalid @enderror" name="phone"
                                                       required
                                                       placeholder="phone"
                                                       value="{{ old('phone') }}">
                                                <label for="phone">Ваш номер телефона</label>
                                            </div>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="reserve_phone" type="text"
                                                       class="w-100 @error('reserve_phone') is-invalid @enderror"
                                                       name="reserve_phone"
                                                       placeholder="reserve_phone">
                                                <label for="reserve_phone">Ваш запасной номер телефона</label>
                                            </div>

                                            @error('reserve_phone')
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
                                                       class="w-100 @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required autocomplete="current-password" placeholder="password">
                                                <label for="password">Ваш пароль</label>
                                            </div>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="form-group w-100">
                                        <div class="input-container w-100">
                                            <div class="form-row w-100">
                                                <input id="password-confirm" type="password"
                                                       class="w-100 @error('password_confirmation') is-invalid @enderror"
                                                       name="password_confirmation"
                                                       required autocomplete="current-password"
                                                       placeholder="password-confirm">
                                                <label for="password-confirm">Повторите пароль</label>
                                            </div>

                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="w-100">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role_id"
                                                   id="inlineRadio1" value="3" checked>
                                            <label class="form-check-label" for="inlineRadio1">Арендатор</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role_id"
                                                   id="inlineRadio3" value="4">
                                            <label class="form-check-label" for="inlineRadio3">Работник</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role_id"
                                                   id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Арендадатель</label>
                                        </div>
                                    </div>

                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-0 justify-content-center">
                                <button type="submit" class="btn auth-button">
                                    ЗАРЕГЕСТРИРОВАТЬСЯ
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
