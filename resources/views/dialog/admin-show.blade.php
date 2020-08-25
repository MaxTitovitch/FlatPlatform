@extends('voyager::master')

@section('content')
    @include('dialog.part.show', ['dialog' => $dialog])
@endsection