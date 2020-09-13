@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.list',  ['dialogs' => $dialogs])
@endsection

@section('main-class') col-md-8 @endsection

@section('right-bar')
    <div class="col-md-2">
        <div class="dialog-list-connect-support btn btn-block btn-outline-primary pt-md-3 mt-md-4">
            <a href="{{ route('dialog-support') }}" class="text-primary h-100">
                Связаться с техподдержкой
            </a>
        </div>
    </div>
@endsection