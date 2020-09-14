@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content'])
@endsection

@section('main-class') col-md-7 @endsection

@section('right-bar')
    <div class="col-md-2">
        @if($dialog->flat_order)
            <div class="w-100 border-left border-primary h-100">
                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРИНЯТЬ</button>
                </form>
                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТКЛОНИТЬ</button>
                </form>
                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>
                </form>
                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">УТВЕРДИТЬ</button>
                </form>
                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРОЕКТ ВЫПОЛНЕН</button>
                </form>
            </div>
        @elseif($dialog->household_service_order)
            @php ($order = $dialog->household_service_order)
            @if($order->status == 'Отменён' || $order->status == 'Отозван')
                <div class="rounded text-danger">{{ $order->status }}</div>
            @elseif($order->status == 'Выполнен')
                <div class="rounded text-success">{{ $order->status }}</div>
            @else
                @if(Auth::id() !== $order->landlord_id)
                    @if(Auth::id() === $order->household_service->user_id)
                        <div class="border border-primary rounded text-center"><a href="{{ route('dialog-service-create', ['id' => $order->household_service->id]) }}" class="text-primary">Написать</a></div>
                    @else
                        <div class="border border-primary rounded text-center"><a href="{{ route('dialog-create', ['id' => $order->landlord_id]) }}" class="text-primary">Написать</a></div>
                    @endif
                @else
                    <div class="border border-danger rounded text-center">
                        <form action="{{ route('service-reject-request', ['id' => $order->id], '_method=path') }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="text-danger btn-nobtn">Отозвать</button>
                        </form>
                    </div>
                @endif
                @if(Auth::id() === $order->household_service->user_id)
                    @if($order->status === 'Создан')
                        <div class="border border-success rounded text-center">
                            <form action="{{ route('service-accept-request', ['id' => $order->id, '_method=path']) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button type="submit" class="text-success btn-nobtn">Принять</button>
                            </form>
                        </div>
                        <div class="border border-danger rounded text-center">
                            <form action="{{ route('service-reject-request', ['id' => $order->id, '_method=path']) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button type="submit" class="text-danger btn-nobtn">Отклонить</button>
                            </form>
                        </div>
                    @endif
                @endif
            @endif
        @endif
    </div>
@endsection
