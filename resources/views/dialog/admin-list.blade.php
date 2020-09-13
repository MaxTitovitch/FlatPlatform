@extends('voyager::master')

@section('content')
    @include('dialog.part.list',  ['dialogs' => $dialogs, 'section' => 'content'])
@endsection

