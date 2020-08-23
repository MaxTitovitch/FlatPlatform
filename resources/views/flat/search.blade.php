@extends('layouts.app')

@section('content')
    <div>
        @dd($flats, $flats->links())
    </div>
@endsection
