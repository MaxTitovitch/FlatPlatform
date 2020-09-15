@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endsection


@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
{{--        carousel--}}
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner ">
            <div class="carousel-item active w-100 carousel-height-img ">
                <div class="w-100 carousel-height-img d-block p-md-5" style="background: no-repeat url({{asset('img/apartment-2094701_960_720.jpg')}}); background-size: 100% 100%">
                    <div>
                        <div class="w-100 text-center main-carousel-text">
                            <span class="text-white w-100 ">Хотите быстро и недорого найти жилье?</span>
                        </div>
                        <div class="main-carousel-btn ">
                            <a href="{{ route('flat-search') }}" class="btn color-bg-dark-blue w-25  text-white">Найти жильё</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item w-100 carousel-height-img ">
                <div class="w-100 carousel-height-img d-block p-md-5" style="background: no-repeat url({{asset('img/entrepreneur-2326419_1921.jpg')}}); background-size: 100% 100%">
                    <div>
                        <div class="w-100 text-center main-carousel-text">
                            <span class="text-white w-100 ">Нужен высококвалифицированный специалист?</span>
                        </div>
                        <div class="main-carousel-btn ">
                            <a href="{{ route('household-service-search') }}" class="btn color-bg-dark-blue w-25  text-white">Найти работника</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item w-100 carousel-height-img ">
                <div class="w-100 carousel-height-img d-block p-md-5" style="background: no-repeat url({{asset('img/computer-768696_19201.jpg')}}); background-size: 100% 100%">
                    <div>
                        <div class="w-100 text-center main-carousel-text">
                            <span class="text-white w-100 ">Хотите больше узнать о нашей компании?</span>
                        </div>
                        <div class="main-carousel-btn ">
                            <a href="{{ route('about') }}" class="btn color-bg-dark-blue w-25  text-white">О компании</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mt-3 mb-4">
        <span class="new-flats-row department ">Новые квартиры</span>

        <div class="new-flats-main mb-5 flat-slider mt-2">
            @foreach($flats as $flat)
                <div class="new-flat-main-one col-lg-4 col-xl-4 col-12 col-sm-12">
                    <a href="{{ route('flat-page', ['id' => $flat->id]) }}">
                        <div class="new-flat-main-img">
                            <img src="{{asset("/storage/".explode("\"", $flat->photos)[1])}}" alt="">
                        </div>
                    </a>
                    <div class="new-flat-main-description">
                        <a href="{{ route('flat-page', ['id' => $flat->id]) }}">
                            <div class="new-flat-main-name mt-2 mb-2">
                                <span>Улица {{$flat->street}}, {{$flat->house_number}}</span>
                            </div>
                        </a>
                        <div class="new-flat-main-cost mb-1">
                            <span class="">{{ $flat->price }} ₽</span>
                        </div>
                        <div class="new-flat-main-text">
                            <span class="">{{ $flat->description }}</span>
                        </div>
                        <div class="new-flat-main-position">
                            <span class="text-secondary">г. {{ $flat->city }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <span class="new-household-row department">Хозяйственные предложения</span>

        <div class="new-households-main household-slider mb-5">
            @foreach($services as $service)
                <div class="new-household-main-one col-md-4">
                    <div class="row">
                        <div class="new-household-main-img mt-3 col-md-5">
                            <a href="{{ route('household-service-page', [$service->id]) }}">
                                <img src="{{asset('/storage/' . $service->user->avatar)}}" alt="">
                            </a>
                        </div>
                        <div class="pl-4 my-auto col-md-7">
                            <div class="new-household-main-type mb-1">
                                <a href="{{ route('household-service-page', [$service->id]) }}">
                                    <span>{{$service->title}}</span>
                                </a>
                            </div>
                            <div class="new-household-main-name mb-1 font-weight-bold">
                                <span>{{ $service->user->name}}</span>
                            </div>
                            <div class="new-household-main-price">
                                <span>{{ $service->price}} ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-household-main-description mt-3 col-md-12">
                            <span>{{ $service->description}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="new-advantage-row department mx-auto text-center mb-3">НАШИ ПРЕИМУЩЕСТВА</div>

        <div class="row ">
            @foreach($statistic as $key => $stat)
                <div class="new-advantage-one  col-lg-3 col-xl-3 col-12 col-sm-12">
                    <div class="statistic-container">
                        <div class="new-advantage-main-img mt-3">
                            <img src="{{asset('img/statistic/' . $key . '.png')}}" alt="">
                        </div>
                        <div class="count text-center mt-2">
                            <span>{{$stat['value']}}</span>
                        </div>
                        <div class="advantage-description">
                            <span>{!! $stat['text']!!}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection
