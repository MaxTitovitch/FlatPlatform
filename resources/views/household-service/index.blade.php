@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endsection

@section('content')
    {{--        <div>--}}
    {{--            @dd($householdService, $dates)--}}
    {{--        </div>--}}

    <div class="">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-6 flat-id-up-title">
                    {{ $householdService->title . ", " . $householdService->city }}
                    <p class="font-18-px text-secondary">{{ $householdService->category->name }}</p>
                </div>
                <div class="col-md-3 flat-id-up-price font-weight-bold">{{ $householdService->price }} P</div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary h-75 btn-block" data-toggle="modal" data-target="#exampleModal">
                        ОТКЛИКНУТЬСЯ
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="flat-id-description border-top border-bottom border-info pb-5">
                        <div class="font-18-px">
                            {{ $householdService->description }}
                        </div>
                    </div>
                    <div class="row my-md-3">
                        <span class="mr-4 font-18-px">Дата создания объявления</span>
                        <span class="text-secondary font-18-px">{{ explode(" ", $householdService->created_at)[0]  }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="connect-owner container-fluid text-center">
                        <span class="text-white">СВЯЗАТЬСЯ С ВЛАДЕЛЦЕМ</span>
                        <div class="row">
                            <div class="my-md-3 w-25">
                                <img class="w-100 ml-md-2 rounded-circle" src="{{ asset('/storage/' . $householdService->user->avatar) }}" alt="">
                            </div>
                            <div class="w-50">
                                <div class="text-md-left ml-md-4 h-100">
                                    <span class="align-middle h-100 text-white ml-md-5 font-18-px">
                                        <p>{{ $householdService->user->name }}</p>
                                        <p>{{ $householdService->user->last_name }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="w-25 text-center align-middle my-auto">
                                <a href="{{ route('dialog-create', ['id' => $householdService->user->id]) }}">
                                    <i class="fa fa-3x fa-envelope-o text-white" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($householdService->orders as $order)
                <div class="row flat-id-renter border-top border-info py-md-3">
                    <div class="col-md-1 flat-id-renter">
                        <img src="{{asset('/storage/' . $order->landlord->avatar)}}" alt="">
                    </div>
                    <div class="col-md-2 my-auto">
                        <span class="flat-id-renter-name">
                            <strong>{{ $order->landlord->name . ' ' . $order->landlord->last_name }}</strong>
                            <p class="text-secondary">{{ date('d.m.Y', strtotime($order->date_start)) }} - {{ date('d.m.Y', strtotime($order->date_end)) }}</p>
                        </span>
                    </div>
                    <div class="col-md-1 my-auto ">
                        <span class="flat-id-renter-price">{{ $order->price }}P</span>
                    </div>
                    <div class="col-md-8 my-auto">
                        <div class="flex">
                            @if($order->status == 'Отменён' || $order->status == 'Отозван')
                                <div class="rounded text-danger">{{ $order->status }}</div>
                            @elseif($order->status == 'Принят' || $order->status == 'Утверждён' || $order->status == 'Выполнен')
                                <div class="rounded text-success">{{ $order->status }}</div>
                            @endif
                            @if(Auth::id() !== $order->landlord_id)
                                @if(Auth::id() === $householdService->user_id)
                                    <div class="border border-primary rounded text-center"><a href="{{ route('dialog-service-create', ['id' => $householdService->id]) }}" class="text-primary">Написать</a></div>
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
                            @if(Auth::id() === $householdService->user_id)
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection


@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/flat-slider.js') }}"></script>
@endsection
















