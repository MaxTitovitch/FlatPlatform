@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content'])
@endsection

@section('main-class') col-md-7 @endsection

@section('right-bar')
    <div class="col-md-2">
        <a href="{{ route('dialog-support') }}" class="dialog-support mt-3">
            Связаться с техподдержкой
        </a>
    </div>
@endsection
