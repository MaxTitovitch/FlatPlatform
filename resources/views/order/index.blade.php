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
        <th scope="col" class="color-dark-blue">Статус квартиры</th>
        <th scope="col" class="color-dark-blue">Статус заявки</th>
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

            @if($order->flat->status == "Свободна")
                <td class="text-success font-weight-bold">
                    {{ $order->flat->status }}
                </td>
            @else
                <td class="text-danger ">
                    {{ $order->flat->status }}
                </td>
            @endif

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
                    <i>г. {{ $order->flat->city . '. ул. ' .$order->flat->street . ", " . $order->flat->house_number}}</i>
                </a>
            </td>
            <td>
                {{ $order->tenant->name . " " . $order->tenant->last_name}}
            </td>
            <td>

                @if($order->flat->status == 'Свободна')
                    @if(Auth::id() !== $order->tenant_id)
                        @if(Auth::id() === $order->flat->user_id)
                            <div class="border border-primary rounded text-center"><a href="{{ route('dialog-flat-create', ['id' => $order->flat->id]) }}" class="text-primary">Написать</a></div>
                        @else
                            <div class="border border-primary rounded text-center"><a href="{{ route('dialog-create', ['id' => $order->tenant_id]) }}" class="text-primary">Написать</a></div>
                        @endif
                    @endif
                    @if(Auth::user()->role->name == 'tenant')
                        @switch($order->status)
                            @case('Создан')
                            <div class="border border-danger rounded text-center">
                                <form action="{{ route("service-reject-request", ['id' => $order->id, '_method=path']) }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-danger btn-nobtn">ОТОЗВАТЬ</button>
                                </form>
                            </div>
                            @break
                            @case('Отован')
                            <div class="border border-warning rounded text-center">
                                <form action="{{ route("service-reject-request", ['id' => $order->id]) }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-warning btn-nobtn">ВЕРНУТЬ СТАВКУ</button>
                                </form>
                            </div>
                            @break
                            @case('Отменён')
                            @break
                            @case('Принят')
                            @if($order->tenant_confirmation == 0 && Auth::user()->role->name == 'tenant')
                                <div class="border border-success rounded text-center">
                                    <form action="{{ route("service-confirm-request", ['id' => $order->id]) }}" method="post" >
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <button type="submit" class="text-success btn-nobtn">ПОДТВЕРДИТЬ</button>
                                    </form>
                                </div>
                            @endif
                            @break
                            @case('Утверждён')
                            @break
                            @case('Выполнен')
                            @break
                        @endswitch
                    @else
                        @switch($order->status)
                            @case('Создан')
                            <div class="border border-warning rounded text-center">
                                <form action="{{ route("service-accept-request", ['id' => $order->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-warning btn-nobtn">ПРИНЯТЬ</button>
                                </form>
                            </div>

                            <div class="border border-danger rounded text-center">
                                <form action="{{ route("service-reject-request", ['id' => $order->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-danger btn-nobtn">ОТКЛОНИТЬ</button>
                                </form>
                            </div>
                            @break
                            @case('Отован')
                            @break
                            @case('Отменён')
                            <div class="border border-warning rounded text-center">
                                <form action="{{ route("service-reject-request", ['id' => $order->id]) }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-warning btn-nobtn">ВЕРНУТЬ СТАВКУ</button>
                                </form>
                            </div>
                            @break
                            @case('Принят')
                            @if($order->landlord_confirmation == 0 && Auth::user()->role->name == 'landlord')
                                <div class="border border-success rounded text-center">
                                    <form action="{{ route("service-confirm-request", ['id' => $order->id]) }}" method="post" >
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <button type="submit" class="text-success btn-nobtn">ПОДТВЕРДИТЬ</button>
                                    </form>
                                </div>
                            @endif
                            @break
                            @case('Утверждён')

                            <div class="border border-success rounded text-center">
                                <form action="{{ route("service-complete-request", ['id' => $order->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="text-success btn-nobtn">ПРОЕКТ ВЫПОЛНЕН</button>
                                </form>
                            </div>
                            @break
                            @case('Выполнен')
                            @break
                        @endswitch
                    @endif
{{--                        <div class="border border-danger rounded text-center">--}}
{{--                            <form action="{{ route('flat-reject-request', ['id' => $order->id], '_method=path') }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="_method" value="PATCH">--}}
{{--                                <button type="submit" class="text-danger btn-nobtn">Отозвать</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if(Auth::id() === $order->flat->user_id)--}}
{{--                        @if($order->status === 'Создан')--}}

{{--                            <div class="border border-success rounded text-center">--}}
{{--                                <form action="{{ route('flat-accept-request', ['id' => $order->id, '_method=path']) }}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                                    <button type="submit" class="text-success btn-nobtn">Принять</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                            <div class="border border-danger rounded text-center">--}}
{{--                                <form action="{{ route('flat-reject-request', ['id' => $order->id, '_method=path']) }}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                                    <button type="submit" class="text-danger btn-nobtn">Отклонить</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endif--}}
                @endif

            </td>
        </tr>
    @endforeach

    </tbody>
</table>

@endsection
