@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content', 'jsSection' => 'scripts', 'cssSection' => null])
@endsection

@if($dialog->household_service_order || $dialog->flat_order)
    @section('main-class') col-md-7 @endsection
@endif

@if($dialog->household_service_order || $dialog->flat_order)
    @section('right-bar')
        <div class="col-md-2">
            @php
                if($dialog->household_service_order) {
                    $order = $dialog->household_service_order;
                    $role = 'landlord';
                    $role2 = 'employee';
                    $model = 'household_service';
                    $modelRoute = 'service';
                } else {
                    $order = $dialog->flat_order;
                    $role = 'tenant';
                    $role2 = 'landlord';
                    $model = 'flat';
                    $modelRoute = 'flat';
                }
                $count = 0;
            @endphp
            @if($order->status == 'Создан')
                <div class="text-center alert-status-dark mt-3 font-size-20">{{ $order->status }}</div>
            @elseif($order->status == 'Отозван' || $order->status == 'Отменён')
                <div class="text-center alert-status-danger mt-3 font-size-20">{{ $order->status }}</div>
            @else
                <div class="text-center alert-status-success mt-3 font-size-20">{{ $order->status }}</div>
            @endif
            @if(Auth::user()->role->name == $role)
                @switch($order->status)
                    @case('Создан')
                        @php($count++)
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id, '_method=path']) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>
                        </form>
                    @break
                    @case('Отозван')
                        @php($count++)
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ВЕРНУТЬ СТАВКУ</button>
                        </form>
                    @break
                    @case('Отменён')
                    @break
                    @case('Принят')
                        @if($order->{"{$role}_confirmation"} == 0 && Auth::user()->role->name == $role)
                            @php($count++)
                            <form action="{{ route("$modelRoute-confirm-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПОДТВЕРДИТЬ</button>
                            </form>
                       @endif
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id, '_method=path']) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>
                        </form>
                    @break
                    @case('Утверждён')
                    @break
                    @case('Выполнен')
                    @break
                @endswitch
            @else
                @switch($order->status)
                    @case('Создан')
                        @php($count++)
                        <form action="{{ route("$modelRoute-accept-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРИНЯТЬ</button>
                        </form>
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТКЛОНИТЬ</button>
                        </form>
                    @break
                    @case('Отозван')
                    @break
                    @case('Отменён')
                        @php($count++)
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ВЕРНУТЬ СТАВКУ</button>
                        </form>
                    @break
                    @case('Принят')
                        @php($count++)
                        @if($order->{"{$role2}_confirmation"} == 0 && Auth::user()->role->name == $role2)
                            @php($count++)
                            <form action="{{ route("$modelRoute-confirm-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПОДТВЕРДИТЬ</button>
                            </form>
                        @endif
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТКЛОНИТЬ</button>
                        </form>
                    @break
                    @case('Утверждён')
                        @php($count++)
                        <form action="{{ route("$modelRoute-complete-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРОЕКТ ВЫПОЛНЕН</button>
                        </form>
                    @break
                    @case('Выполнен')
                    @break
                @endswitch
            @endif
        </div>
    @endsection
@endif
