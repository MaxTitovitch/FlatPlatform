@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-container card">

                    <div class="card-body auth-container-left">

                        <h1>Сброс пароля</h1>
                        <div class="mb-5">
                            Поожалуйста, введите Ваш новый пароль
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">


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

                            <div class="form-group row mb-0">
                                <button type="submit" class="btn auth-button auth-button-reset-password">
                                    СОХРАНИТЬ
                                </button>
                            </div>

                        </form>
                    </div>

                    <div class="card-body auth-container-right mt-2">
                        <div class="container">
                            <div>
                                <p><span>Вы не хотите сбрасывать пароль?</span></p>
                            </div>
                            <div class="mt-5 btn-block">
                                <a href="{{ route('login') }}" type="button"
                                   class="btn auth-button">ОТМЕНА</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
