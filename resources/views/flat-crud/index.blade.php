@extends('layouts.personal')

@section('personal-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-10">

                <div class="text-center mt-md-3">
                    <h1>Сдача недвижимости в аренду</h1>
                </div>

                <a href="" class="personal-area-flats-plus color-bg-dark-blue text-white">
                    <big><i class="fa fa-plus-circle" aria-hidden="true"></i></big> Добавить объявление
                </a>
            </div>
        </div>
@endsection
