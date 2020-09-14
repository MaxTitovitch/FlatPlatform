@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content'])
@endsection

@section('main-class') col-md-7 @endsection

@section('right-bar')
    <div class="col-md-2">
        @if($dialog->household_service_order || $dialog->flat_order)
            @php
                if($dialog->household_service_order) {
                    $order = $dialog->household_service_order;
                    $role = 'landlord';
                    $model = 'household_service';
                    $modelRoute = 'service';
                } else {
                    $order = $dialog->flat_order;
                    $role = 'tenant';
                    $model = 'flat';
                    $modelRoute = 'flat';
                }
            @endphp

            @if(Auth::user()->role->name = $role)
                @switch($order->status)
                    @case('Создан')
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id, '_method=path']) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>
                        </form>
                    @break
                    @case('Отован')
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ВЕРНУТЬ СТАВКУ</button>
                        </form>
                    @break
                    @case('Отклонён')
                    @break
                    @case('Принят')
                        <form action="{{ route("$modelRoute-confirm-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПОДТВЕРДИТЬ</button>
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
                    @case('Отован')
                    @break
                    @case('Отклонён')
                        <form action="{{ route("$modelRoute-reject-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ВЕРНУТЬ СТАВКУ</button>
                        </form>
                    @break
                    @case('Принят')
                        <form action="{{ route("$modelRoute-confirm-request", ['id' => $order->id]) }}" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПОДТВЕРДИТЬ</button>
                        </form>
                    @break
                    @case('Утверждён')
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
        @endif
    </div>
@endsection
