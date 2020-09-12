@extends('layouts.app')

@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endsection

@section('content')

    <div class="container-fluid">
        {{--        @dd($user)--}}
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-10">
                <div class="text-center mt-md-3">
                    <h1>Персональная информация</h1>
                </div>




                <form method="POST" action="{{ route('home') }}">
                    @if (session('status-error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status-error') }}
                        </div>
                    @endif
                    <div class="row mt-md-5 mx-md-5">
                        <div class="col-md-3 personal-area-account pl-md-4">
                            <div class="form-group border-bottom">
                                <input name="name" class="border-0 w-100" type="text" placeholder="Имя">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="last_name" class="border-0 w-100" type="text" placeholder="Фамилия">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="phone" class="border-0 w-100" type="text" placeholder="Номер телефона">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="reserve_phone" class="border-0 w-100" type="text"
                                       placeholder="Запасной номер">
                            </div>
                            <div class="form-group border-bottom">
                                <input class="border-0 w-100 datepicker" type="text"
                                       data-provide="datepicker" name="date_of_birth" autocomplete="off"
                                       placeholder="Дата рождения">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="passport_number" class="border-0 w-100" type="number"
                                       placeholder="Номер паспорта">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="date_of_issue" class="datepicker border-0 w-100"
                                       placeholder="Дата выдачи паспорта"
                                       data-provide="datepicker" type="text" name="passportDay" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 px-md-5 personal-area-account ">
                            <div class="form-group border-bottom mb-md-0 pb-md-0">
                                <input name="last_password" class="border-0 w-100" type="password"
                                       placeholder="Текущий пароль">
                            </div>
                            <p class="">Требуется, если Вы хотите изменить E-mail или Пароль ниже</p>
                            <div class="form-group border-bottom">
                                <input type="email" name="email" class="border-0 w-100 mt-md-4" type="email"
                                       placeholder="Почта">
                            </div>
                            <p class="mt-md-5 mb-md-4">Для изменения текущего пароля введите новый пароль в обоих
                                полях</p>
                            <div class="form-group border-bottom mt-md-5">
                                <input name="password" class="border-0 w-100" type="password"
                                       placeholder="Новый пароль">
                            </div>
                            <div class="form-group border-bottom">
                                <input name="password_confirmation" class="border-0 w-100" type="password"
                                       placeholder="Повторите пароль">
                            </div>
                            <button type="submit" class="color-bg-dark-blue w-100">
                                <a href="" class="btn text-white btn-block">СОХРАНИТЬ</a>
                            </button>
                        </div>
                        <div class="col-md-4 pl-md-5 ">
                            <div class="avatar-text text-center">
                                <span class="text-center">Аватар</span>
                            </div>
                            <div class="avatar-img text-center mt-md-4">
                                <i class="fa fa-user-circle color-dark-blue" aria-hidden="true"></i>
                            </div>
                            <div class="custom-file mt-md-3 ">
                                <input type="file" class="display-none fileblabla" id="validatedCustomFile" required>
                                <p class="upload-avatar color-dark-blue text-center">
                                    <i class="fa fa-cloud-upload mr-2" aria-hidden="true"></i>
                                    Загрузить
                                </p>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>


    </div>
@endsection

@section('scripts')

    <script>
        $('.upload-avatar').click(() => {
            $('.fileblabla').click();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/calendar/calendar-home.js') }}"></script>
@endsection


