@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog])
@endsection
