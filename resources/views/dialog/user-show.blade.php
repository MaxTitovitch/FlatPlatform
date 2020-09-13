@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content'])
@endsection
