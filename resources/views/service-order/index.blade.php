@extends('layouts.personal')

@section('personal-content')
    {{--        <div>--}}
    {{--            @dd($orders)--}}
    {{--        </div>--}}

    <div class="mt-md-3">
        <h1>Заявки на хозработы</h1>
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
            <th scope="col" class="color-dark-blue">Дата выполнения</th>
            <th scope="col" class="color-dark-blue">Категория</th>
            <th scope="col" class="color-dark-blue">Статус</th>
            <th scope="col" class="color-dark-blue">Адрес</th>
            <th scope="col" class="color-dark-blue">Заказчик</th>
            <th scope="col" class="color-dark-blue">Данные работника</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
{{--                @dump($orders)--}}
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->date_of_completion }}</td>
                <td>{{ $order->household_service->category->name }}</td>

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
                    {{ $order->flat->user->name . " " . $order->flat->user->last_name }}

                </td>

                <td>
                    <a class="color-dark-blue"
                       href="{{ route('household-service-page', ['id' => $order->household_service->id]) }}">
                        <i>{{ $order->employee->name . " " . $order->employee->last_name}}</i>
                    </a>
                </td>
                <td>


                @if(Auth::id() !== $order->landlord_id)
                    @if(Auth::id() === $order->household_service->user_id)
                        <div class="border border-primary rounded text-center"><a href="{{ route('dialog-service-create', ['id' => $order->household_service->id]) }}" class="text-primary">Написать</a></div>
                    @else
                        <div class="border border-primary rounded text-center"><a href="{{ route('dialog-create', ['id' => $order->landlord_id]) }}" class="text-primary">Написать</a></div>
                    @endif
                @endif
                @if(Auth::user()->role->name == 'landlord')
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
                            @if($order->employee_confirmation == 0 && Auth::user()->role->name == 'tenant')
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




{{--                    <div class="border border-danger rounded text-center">--}}
{{--                        <form action="{{ route('service-reject-request', ['id' => $order->id], '_method=path') }}" method="post">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="_method" value="PATCH">--}}
{{--                            <button type="submit" class="text-danger btn-nobtn">Отозвать</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if(Auth::id() === $order->household_service->user_id)--}}
{{--                    @if($order->status === 'Создан')--}}
{{--                        <div class="border border-warning rounded text-center">--}}
{{--                            <form action="{{ route('service-accept-request', ['id' => $order->id, '_method=path']) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="_method" value="PATCH">--}}
{{--                                <button type="submit" class="text-warning btn-nobtn">Вернуть</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="border border-danger rounded text-center">--}}
{{--                            <form action="{{ route('service-reject-request', ['id' => $order->id, '_method=path']) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="_method" value="PATCH">--}}
{{--                                <button type="submit" class="text-danger btn-nobtn">Отклонить</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endif--}}





{{--                    <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="_method" value="PATCH">--}}
{{--                        <button class="py-md-1 text-decoration-none border border-success text-center btn-block text-success">--}}
{{--                            Принять--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                    <form method="post" class="mt-md-1" action="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="_method" value="PATCH">--}}
{{--                        <button class="py-md-1 text-decoration-none border border-danger text-center btn-block text-danger">--}}
{{--                            Отклонить--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                    <a class="mt-md-1 py-md-1 text-decoration-none border border-primary text-center btn-block text-primary"--}}
{{--                       href="{{ route('household_services.edit', ['household_service' => $order->id]) }}">--}}
{{--                            Диалог--}}
{{--                    </a>--}}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
