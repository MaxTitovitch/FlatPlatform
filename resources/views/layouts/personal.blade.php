@extends('layouts.app')

@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="@section('main-class') col-md-10 @show">
                @yield('personal-content')
            </div>
            @section('right-bar')
            @show
        </div>
    </div>
@endsection

