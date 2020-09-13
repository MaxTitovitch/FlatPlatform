@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.list',  ['dialogs' => $dialogs, 'section' => 'personal-content'])
@endsection

@section('main-class') col-md-8 @endsection

@section('right-bar')
    <div class="col-md-2">
        <a href="{{ route('dialog-support') }}" class="dialog-support mt-3">
            Связаться с техподдержкой
        </a>
    </div>
@endsection