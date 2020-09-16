@extends('voyager::master')

@section('content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'content', 'jsSection' => 'javascript', 'cssSection' => 'css'])
@endsection