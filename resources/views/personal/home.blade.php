@extends('layouts.personal')

@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endsection

@section('personal-content')
    <div class="text-center mt-md-3">
        <h1>Персональная информация</h1>
    </div>

    <form enctype="multipart/form-data" method="POST" action="{{ route('home') }}" class="style-reset">
        @if (session('status-error'))
            <div class="alert alert-danger" role="alert">
                {{ session('status-error') }}
            </div>
        @endif
        @if (session('status-success'))
            <div class="alert alert-success" role="alert">
                {{ session('status-success') }}
            </div>
        @endif
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="row mt-md-5 mx-md-5">
            <div class="col-md-3 personal-area-account pl-md-4">
                <div class="form-group border-bottom">
                    <input name="name" class="border-0 w-100  @error('name') is-invalid @enderror" type="text" placeholder="Имя" value="{{ Auth::user()->name }}" required>
                </div>
                @error('name')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input name="last_name" class="border-0 w-100 @error('last_name') is-invalid @enderror" type="text" placeholder="Фамилия" value="{{ Auth::user()->last_name }}" required>
                </div>
                @error('last_name')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input name="phone" class="border-0 w-100 @error('phone') is-invalid @enderror" type="text" placeholder="Номер телефона" value="{{ Auth::user()->phone }}" required>
                </div>
                @error('phone')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input name="reserve_phone" class="border-0 w-100 @error('reserve_phone') is-invalid @enderror" type="text" placeholder="Запасной номер" value="{{ Auth::user()->reserve_phone }}">
                </div>
                @error('reserve_phone')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input class="border-0 w-100 datepicker @error('date_of_birth') is-invalid @enderror" type="text" data-provide="datepicker" required
                           name="date_of_birth" autocomplete="off" placeholder="Дата рождения" value="{{ Auth::user()->date_of_birth }}">
                </div>
                @error('date_of_birth')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input name="passport_number" class="border-0 w-100 @error('passport_number') is-invalid @enderror" type="number" required
                           placeholder="Номер паспорта" value="{{ Auth::user()->passport_number }}">
                </div>
                    @error('passport_number')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <div class="form-group border-bottom">
                    <input name="date_of_issue" class="datepicker border-0 w-100 @error('date_of_issue') is-invalid @enderror" placeholder="Дата выдачи паспорта" required
                           data-provide="datepicker" type="text" autocomplete="off" value="{{ Auth::user()->date_of_issue }}">
                </div>
                @error('date_of_issue')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="col-md-5 px-md-5 personal-area-account ">
                <div class="form-group border-bottom mb-md-0 pb-md-0">
                    <input name="last_password" class="border-0 w-100 @error('last_password') is-invalid @enderror" type="password" placeholder="Текущий пароль">
                </div>
                <p class="">Требуется, если Вы хотите изменить E-mail или Пароль ниже</p>
                @error('last_password')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input type="email" name="email" class="border-0 w-100 mt-md-4 @error('email') is-invalid @enderror" placeholder="Почта"  value="{{ Auth::user()->email }}" required>
                </div>
                @error('email')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <p class="mt-md-5 mb-md-4">Для изменения текущего пароля введите новый пароль в обоих полях</p>
                <div class="form-group border-bottom mt-md-5">
                    <input name="password" class="border-0 w-100 @error('password') is-invalid @enderror" type="password" placeholder="Новый пароль">
                </div>
                @error('password')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="form-group border-bottom">
                    <input name="password_confirmation" class="border-0 w-100 @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Повторите пароль">
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback-home" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button type="submit" class="color-bg-dark-blue w-100">
                    <span class="btn text-white btn-block">СОХРАНИТЬ</span>
                </button>
            </div>
            <div class="col-md-4 pl-md-5 ">
                <div class="avatar-text text-center">
                    <span class="text-center">Аватар</span>
                </div>
                <div class="avatar-img text-center mt-md-4 w-100">
                    <img class="upload-avatar br-50 image-user w-100" src="{{ asset('/storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->last_name }}">
                </div>
                <div class="custom-file mt-md-3 ">
                    <input type="file" class="display-none fileblabla" id="validatedCustomFile" name="avatar">
                    <p class="upload-avatar color-dark-blue text-center">
                        <i class="fa fa-cloud-upload mr-2" aria-hidden="true"></i> Загрузить
                    </p>
                </div>
                @error('file')
                <span class="invalid-feedback-home" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </form>
@endsection

@section('scripts')

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/calendar/calendar-home.js') }}"></script>
@endsection


