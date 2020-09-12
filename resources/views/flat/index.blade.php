@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mobiscroll.jquery.min.css') }}"/>
@endsection

@section('content')
    <div class="dates display-none">
        {{ json_encode ($dates) }}
    </div>

    <div class="">
        <div class="container">
            {{--            кол-во комнат, дом/квартира, улица, номер дома, город--}}
            <div class="row my-4">
                <div class="col-md-7 flat-id-up-title">Аренда</div>
                <div class="col-md-3 flat-id-up-price font-weight-bold">{{ $flat->price }} P/мес.</div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        ОТКЛИКНУТЬСЯ
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content w-100 justify-content-center text-center mx-auto px-md-5">
                                <div class="modal-header text-center text-white border-0">
                                    <h5 class="modal-title text-center w-100" id="exampleModalLabel">Заявка на квартиру</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body py-md-0">
                                    <div id="multi-day1"></div>
                                    <form action="" class="mt-md-4">
                                        <div class="form-group">
                                            <input type="number" name="amount_month" class="form-control" placeholder="Количество месяцев">
                                        </div>
                                        <div class="form-group mt-md-4">
                                            <input type="number" name="price" class="form-control" placeholder="Цена">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer border-0 text-center justify-content-center pt-md-1">
                                    <button type="submit" class="btn btn-block bg-white color-dark-blue font-weight-bold" style="border-radius: 20px; font-size: 1.2rem">ОТПРАВИТЬ ЗАЯВКУ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid ">
            <div class="row-self">
                <div class="new-flats-main mb-5 flat-id-slider mt-2">
                    @php($photos = explode("\"", $flat->photos))
                    @for($i = 0; $i < count($photos); $i++)
                        @if($i % 2 == 1)
                            <div class="new-flat-main-one col-lg-4 col-xl-4 col-12 col-sm-12 slick-slide-break">
                                <div class="flat-main-img">
                                    <img src="{{asset("/storage/".$photos[$i])}}" alt="">
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mt-2">
                        <div class="col-md-4">Тип помещения</div>
                        <div class="col-md-2 flat-id-param">{{ $flat->type_of_premises }}</div>
                        <div class="col-md-3">Тип аренды</div>
                        <div class="col-md-3 flat-id-param">{{ $flat->rental_period }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">Улица</div>
                        <div class="col-md-2 flat-id-param">{{ $flat->street }}</div>
                        <div class="col-md-3">Количество комнат</div>
                        <div class="col-md-3 flat-id-param">{{ $flat->number_of_rooms }}</div>
                    </div>
                    <div class="row mt-2 border-bottom border-info pb-5">
                        <div class="col-md-4">Общая площадь / жилая</div>
                        <div class="col-md-2 flat-id-param">{{ $flat->area }} / {{ $flat->living_area }} кв.м</div>
                        <div class="col-md-3">Этаж</div>
                        <div class="col-md-3 flat-id-param">{{ $flat->floor }}</div>
                    </div>
                    <div class="row flat-id-description mt-md-5 border-bottom border-info pb-5">
                        <div class="col-md-3">
                            Описание
                        </div>
                        <div class="col-md-9 font-18-px">
                            {{ $flat->description }}
                        </div>
                    </div>
                    <div class="row my-md-3">
                        <span class="mr-4 font-18-px">Дата создания объявления</span>
                        <span class="text-secondary font-18-px">{{ explode(" ", $flat->created_at)[0]  }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="connect-owner container-fluid text-center">
                        <span class="text-white">СВЯЗАТЬСЯ С ВЛАДЕЛЦЕМ</span>
                        <div class="row">
                            <div class="my-md-3 w-25">
                                <img class="w-100 ml-md-2 br-50" src="{{ asset('/storage/' . $flat->user->avatar) }}" alt="">
                            </div>
                            <div class="w-50">
                                <div class="text-md-left ml-md-4 h-100">
                                    <span class="align-middle h-100 text-white ml-md-5 font-18-px">
                                        <p>{{ $flat->user->name }}</p>
                                        <p>{{ $flat->user->last_name }}</p>
                                    </span>
                                </div>
                            </div>
                            @guest
                            @else
                                @if(Auth::id() !== $flat->user->id)
                                    <div class="w-25 text-center align-middle my-auto">
                                        <a href="{{ route('dialog-create', ['id' => $flat->user->id]) }}">
                                            <i class="fa fa-3x fa-envelope-o text-white" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @endif
                            @endguest
                        </div>
                    </div>
                    <div id="multi-day"></div>
                </div>
            </div>
            @guest
                <h2 class="mt-5 mb-5 text-secondary text-center">Доступно только авторизованным пользователям</h2>
            @else
                @foreach($flat->orders as $order)
                    <div class="row flat-id-renter border-top border-info py-md-3">
                        <div class="col-md-1 flat-id-renter">
                            <img src="{{asset('/storage/' . $order->tenant->avatar)}}" alt="">
                        </div>
                        <div class="col-md-2 my-auto">
                            <span class="flat-id-renter-name">
                                <strong>{{ $order->tenant->name . ' ' . $order->tenant->last_name }}</strong>
                                <p class="text-secondary">{{ date('d.m.Y', strtotime($order->date_start)) }} - {{ date('d.m.Y', strtotime($order->date_end)) }}</p>
                            </span>
                        </div>
                        <div class="col-md-1 my-auto ">
                            <span class="flat-id-renter-price">{{ $order->price }}P</span>
                        </div>
                        <div class="col-md-8 my-auto">
                            <div class="flex">
                                @if(Auth::id() !== $order->tenant->id)
                                    <div class="border border-dark rounded text-center"><a href="" class="text-dark">Написать</a></div>
                                @else
                                    <div class="border border-dark rounded text-danger"><a href="" class="text-dark">Отозвать</a></div>
                                @endif
                                @if(Auth::id() === $flat->user->id)
                                    @if($order->status === 'Создан')
                                        <div class="border border-primary rounded text-center"><a href="" class="text-primary">Принять</a></div>
                                        <div class="border border-info rounded text-danger"><a href="" class="text-info">Отклонить</a></div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endguest
        </div>
    </div>


@endsection


@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/flat-slider.js') }}"></script>
    <script src="{{ asset('js/mobiscroll.jquery.min.js') }}"></script>
    <script src="{{ asset('js/calendar/calendar.js') }}"></script>
    <script src="{{ asset('js/calendar/calendar-date-range.js') }}"></script>

@endsection














