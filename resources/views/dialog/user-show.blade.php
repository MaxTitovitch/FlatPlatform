@extends('layouts.app')

@section('content')
    @include('dialog.part.show', ['dialog' => $dialog])
@endsection
