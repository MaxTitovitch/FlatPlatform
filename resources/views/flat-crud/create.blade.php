@extends('layouts.personal')

@section('personal-content')
    @dump($flat)
    <div class="container">
        <div class="text-left mt-md-3 ">
            <h1>Редактирование объявления</h1>
        </div>

        <div class="personal-area-flats">
            <div class="row mt-md-4">
                <div class="col-md-6 ">
                    <select name="type_of_premises" id="" class="w-100 form-control ">
                        <option {{ $flat->type_of_premises=='Квартира' ? 'selected' : '' }}>Квартира</option>
                        <option {{ $flat->type_of_premises=='Частный дом' ? 'selected' : '' }}>Частный дом</option>
                        <option {{ $flat->type_of_premises=='Комната' ? 'selected' : '' }}>Комната</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="rental_period" id="" class="w-100  form-control">
                        <option value="">Помесячно</option>
                        <option value="">Посуточно</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
