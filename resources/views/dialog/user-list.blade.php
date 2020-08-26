@extends('layouts.app')

@section('content')
    @include('dialog.part.list',  ['dialogs' => $dialogs])
@endsection
