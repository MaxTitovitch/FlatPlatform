@extends('layouts.personal')

@section('personal-content')

    <div class="mt-md-3">
        <h1>Сдача недвижимости в аренду</h1>
    </div>

    <div class="mt-md-4">
        <a href="{{ route('flats.create') }}" class="personal-area-flats-plus color-bg-dark-blue text-white px-md-5 py-md-1">
            Добавить объявление
        </a>
    </div>

    <table class="table mt-md-3">
        <thead>
        <tr>
            <th scope="col">Фотография</th>
            <th scope="col">Тип жилья</th>
            <th scope="col">Тип аренды</th>
            <th scope="col">Кол-во комнат</th>
            <th scope="col">Город</th>
            <th scope="col">Адрес</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($flats as $flat)
            <tr>
                <td class="personal-area-flats-table-img"><img src="{{ asset('/storage/' . explode('"', $flat->photos)[1])  }}" alt=""></td>
                <td>{{ $flat->type_of_premises }}</td>
                <td>{{ $flat->rental_period }}</td>
                <td>{{ $flat->number_of_rooms }}</td>
                <td>{{ $flat->city }}</td>
                <td>ул. {{ $flat->street }}, {{ $flat->house_number }}</td>
                <td>
                    <a href="{{ route('flats.edit', ['flat' => $flat->id]) }}" class="py-md-1 text-decoration-none border border-warning text-center btn-block text-warning">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
                    </a>
                    <form action="{{ route('flats.destroy', ['flat' => $flat->id], '_method=path') }}" method="post" class="py-md-1 border border-danger text-center btn-block">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" class="text-danger btn-nobtn "><i class="fa fa-trash" aria-hidden="true"></i> Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
