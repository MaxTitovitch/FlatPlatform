@extends('layouts.personal')

@section('personal-content')
    <div class="mt-md-3">
        <h1>Хозпредложения</h1>
    </div>

    <div class="mt-md-4">
        <a href="{{ route('household_services.create') }}" class="personal-area-flats-plus color-bg-dark-blue text-white px-md-5 py-md-1">
            Добавить объявление
        </a>
    </div>

    <div class="mt-md-4 style-reset">

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
    </div>

    <table class="table mt-md-3">
        <thead>
        <tr>
            <th scope="col">Заголовок</th>
            <th scope="col">Категория</th>
            <th scope="col">Город</th>
            <th scope="col">Цена</th>
            <th scope="col">Описание</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
{{--        @dump($services)--}}
        @foreach($services as $service)
            <tr>
                <td>{{ $service->title }}</td>
                <td>{{ $service->category->name }}</td>
                <td>{{ $service->city }}</td>
                <td>{{ $service->price }} P</td>
                <td style="max-width: 300px">{{ $service->description }}</td>
                <td>
                    <a href="{{ route('household-service-page', ['id' => $service->id]) }}" class="py-md-1 text-decoration-none border border-primary text-center btn-block text-primary">
                        <i class="fa fa-yes" aria-hidden="true"></i> Просмотр
                    </a>
                    <a href="{{ route('household_services.edit', ['household_service' => $service->id]) }}" class="py-md-1 text-decoration-none border border-warning text-center btn-block text-warning">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
                    </a>
                    <form action="{{ route('household_services.destroy', ['household_service' => $service->id]) }}" method="post" class="py-md-1 border border-danger text-center btn-block">
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
