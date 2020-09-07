@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-container card">

                    <div class="card-body auth-container-left">

                        <h1>Продолжение регистрации</h1>
                        <div class="mb-5">Теперь введите Ваши недостоющие данные</div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('socialite.save', ['provider' => $provider]) }}">
                            @csrf

                            <div class="form-group w-100">
                                <div class="input-container w-100">

                                    @if($isNeedEmail)
                                        <div class="form-group w-100">
                                            <div class="input-container w-100">
                                                <div class="form-row w-100">
                                                    <input id="email" type="text"
                                                           class="w-100 @error('email') is-invalid @enderror"
                                                           name="email"
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
                                    @endif


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


                                    <div class="w-100 @error('role_id') is-invalid @enderror" value="{{ old('role_id') }}">
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
                                <p><span>Передумали регистрироваться? Хотите перейти на главную страницу?</span></p>
                            </div>
                            <div class="mt-5 btn-block">
                                <a href="{{ route('index') }}" type="button"
                                   class="btn auth-button">ДА</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
