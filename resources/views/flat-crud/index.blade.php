@extends('layouts.personal')

@section('personal-content')
    <div class="mt-md-3">
        <h1>Сдача недвижимости в аренду</h1>
    </div>

    <div class="mt-md-4">
        <a href="{{ route('flats.create') }}" class="personal-area-flats-plus color-bg-dark-blue text-white px-md-5 py-md-1">
            <big><i class="fa fa-plus-circle" aria-hidden="true"></i></big> Добавить объявление
        </a>
    </div>
    @if (session('status-error'))
        <div class="alert alert-danger" role="alert">
            {{ session('status-error') }}
        </div>
    @endif
    @if (session('status-success'))
        <div class="alert alert-success" role="alert">
            {{ session('status-success') }}
        </div>
    @endif

    <table class="table mt-md-3">
        <thead>
        <tr>
            <th scope="col">Фотография</th>
            <th scope="col">Статус</th>
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
                <td>
                    @if($flat->status == 'Сдаётся')
                        <span class="text-success font-weight-bold">{{ $flat->status }}</span>
                    @else
                        <span class="text-danger font-weight-bold">{{ $flat->status }}</span>
                    @endif
                </td>
                <td>{{ $flat->type_of_premises }}</td>
                <td>{{ $flat->rental_period }}</td>
                <td>{{ $flat->number_of_rooms }}</td>
                <td>{{ $flat->city }}</td>
                <td>ул. {{ $flat->street }}, {{ $flat->house_number }}</td>
                <td>
                    <a href="{{ route('flat-page', ['id' => $flat->id]) }}" class="py-md-1 text-decoration-none border border-primary text-center btn-block text-primary">
                        <i class="fa fa-yes" aria-hidden="true"></i> Просмотр
                    </a>
                    <a href="{{ route('flats.edit', ['flat' => $flat->id]) }}" class="py-md-1 text-decoration-none border border-warning text-center btn-block text-warning">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
                    </a>
                    <form action="{{ route('flats.destroy', ['flat' => $flat->id]) }}" method="post" class="py-md-1 border border-danger text-center btn-block">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-danger btn-nobtn "><i class="fa fa-trash" aria-hidden="true"></i> Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
