@extends('layouts.app')

@section('content')
{{--    <div>--}}
{{--        @dd($flat)--}}
{{--    </div>--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-10">

                <div class="text-center mt-md-3">
                    <h1>Редактирование объявления</h1>
                </div>

                <div class="personal-area-flats">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="type_of_premises" id="">
                                @foreach($flats as $flat)
                                    <option value="{{ $flat->type_of_premises }}">{{ $flat->type_of_premises }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="" id="">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
