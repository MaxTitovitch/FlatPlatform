@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endsection


@section('content')

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active w-100 carousel-height-img">
                <div class="w-100 carousel-height-img d-block"
                     style="background: no-repeat url({{asset('img/apartment-2094701_960_720.jpg')}}); background-size: 100% 100%">

                </div>
            </div>
            <div class="carousel-item w-100 carousel-height-img">
                <div class="w-100 carousel-height-img d-block"
                     style="background: no-repeat url({{asset('img/apartment-2094701_960_720.jpg')}}); background-size: 100% 100%">

                </div>
            </div>
            <div class="carousel-item w-100 carousel-height-img">
                <div class="w-100 carousel-height-img d-block"
                     style="background: no-repeat url({{asset('img/apartment-2094701_960_720.jpg')}}); background-size: 100% 100%">

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
                            <span class="">200 000 $</span>
                        </div>
                        <div class="new-flat-main-text">
                            <span class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias dolorem ducimus illo illum impedit ipsa, magni nesciunt nihil provident tempore tenetur ut vel velit, vero, voluptatibus. Dolorem nesciunt reprehenderit vel?</span>
                        </div>
                        <div class="new-flat-main-position">
                            <span class="text-secondary">г. Минск</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <span class="new-household-row department">Хозяйственные предложения</span>

        <div class="new-households-main household-slider mb-5">
            @foreach($services as $service)
                <div class="new-household-main-one col-lg-4 col-xl-4 col-12 col-sm-12">
                    <a href="{{ route('household-service-page', [$service->id]) }}">
                        <div class="row">
                            <div class="new-household-main-img mt-3">
                                <img src="{{asset('/storage/' . $service->user->avatar)}}" alt="">
                            </div>
                            <div class="personal-info my-auto">
                                <div class="new-household-main-type mb-1">
                                    <span>{{$service->title}}</span>
                                </div>
                                <div class="new-household-main-name mb-1 font-weight-bold">
                                    <span>{{ $service->user->name}}</span>
                                </div>
                                <div class="new-household-main-price">
                                    <span>3 000 $</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="new-household-main-description mt-3">
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam debitis, quaerat. A dolore dolorum earum exercitationem id maxime mollitia nisi pariatur tenetur veritatis. Nihil, officia, tenetur. Accusamus deserunt quidem voluptas?</span>
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
