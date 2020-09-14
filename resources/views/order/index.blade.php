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
                @if($order->status == 'Отменён' || $order->status == 'Отозван')
                    <div class="rounded text-danger">{{ $order->status }}</div>
                @elseif($order->status == 'Принят' || $order->status == 'Утверждён' || $order->status == 'Выполнен')
                    <div class="rounded text-success">{{ $order->status }}</div>
                @elseif($order->flat->status == 'Свободна')
                    @if(Auth::id() !== $order->tenant_id)
                        @if(Auth::id() === $order->flat->user_id)
                            <div class="border border-primary rounded text-center"><a href="{{ route('dialog-flat-create', ['id' => $order->flat->id]) }}" class="text-primary">Написать</a></div>
                        @else
                            <div class="border border-primary rounded text-center"><a href="{{ route('dialog-create', ['id' => $order->tenant_id]) }}" class="text-primary">Написать</a></div>
                        @endif
                    @else
                        <div class="border border-danger rounded text-center">
                            <form action="{{ route('flat-reject-request', ['id' => $order->id], '_method=path') }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button type="submit" class="text-danger btn-nobtn">Отозвать</button>
                            </form>
                        </div>
                    @endif
                    @if(Auth::id() === $order->flat->user_id)
                        @if($order->status === 'Создан')

                            <div class="border border-success rounded text-center">
                                <form action="{{ route('flat-accept-request', ['id' => $order->id, '_method=path']) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-success btn-nobtn">Принять</button>
                                </form>
                                {{--                                                <a href="{{ route('flat-accept-request', ['id' => $order->id, '_method=path']) }}" class="text-success">Принять</a>--}}
                            </div>
                            <div class="border border-danger rounded text-center">
                                <form action="{{ route('flat-reject-request', ['id' => $order->id, '_method=path']) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-danger btn-nobtn">Отклонить</button>
                                </form>
                                {{--                                                <a href="{{ route('flat-reject-request', ['id' => $order->id, '_method=path']) }}" class="text-danger">Отклонить</a>--}}
                            </div>
                        @endif
                    @endif
                @endif




{{--                <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button class="py-md-1 text-decoration-none border border-success text-center btn-block text-success">--}}
{{--                        Принять--}}
{{--                    </button>--}}
{{--                </form>--}}

{{--                <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button class="py-md-1 text-decoration-none border border-danger text-center btn-block text-danger">--}}
{{--                        Отклонить--}}
{{--                    </button>--}}
{{--                </form>--}}

{{--                <a class="mt-md-1 py-md-1 text-decoration-none border border-primary text-center btn-block text-primary"--}}
{{--                   href="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                    Диалог--}}
{{--                </a>--}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

@endsection
