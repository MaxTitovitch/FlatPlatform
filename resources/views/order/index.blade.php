@extends('layouts.personal')

@section('personal-content')
{{--    <div>--}}
{{--        @dd($orders)--}}
{{--    </div>--}}

<div class="mt-md-3">
    <h1>Заявки на квартиры</h1>
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
        <th scope="col" class="color-dark-blue">Дата начала аренды</th>
        <th scope="col" class="color-dark-blue">Дата завершения аренды</th>
        <th scope="col" class="color-dark-blue">Статус</th>
        <th scope="col" class="color-dark-blue">Квартира</th>
        <th scope="col" class="color-dark-blue">Данные арендодателя</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
{{--            @dump($orders)--}}
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->date_start }}</td>
            <td>{{ $order->date_end }}</td>

            @if($order->status == "Создан")
                <td class="text-dark">
                    {{ $order->status }}
                </td>
            @elseif($order->status == "Принят" || $order->status == "Утверждён" || $order->status == "Выполнен")
                <td class="text-success font-weight-bold">
                    {{ $order->status }}
                </td>
            @elseif($order->status == "Отменён" || $order->status == "Отозван")
                <td class="text-danger ">
                    {{ $order->status }}
                </td>
            @endif

            <td>
                <a class="color-dark-blue"
                   href="{{ route('flat-page', ['id' => $order->flat->id]) }}">
                    <i> {{ $order->flat->street . ", " . $order->flat->house_number}}</i>
                </a>
            </td>
            <td>
                {{ $order->tenant->name . " " . $order->tenant->last_name}}
            </td>
            <td>
                <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button class="py-md-1 text-decoration-none border border-success text-center btn-block text-success">
                        Принять
                    </button>
                </form>

                <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button class="py-md-1 text-decoration-none border border-danger text-center btn-block text-danger">
                        Отклонить
                    </button>
                </form>

                <a class="mt-md-1 py-md-1 text-decoration-none border border-primary text-center btn-block text-primary"
                   href="{{ route('household_services.edit', ['household_service' => $order->id]) }}">
                    Диалог
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

@endsection
