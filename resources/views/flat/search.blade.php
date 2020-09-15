@extends('layouts.app')

@section('content')
    {{--        <div>--}}
    {{--            @dd($flats, $flats->links())--}}
    {{--        </div>--}}


    <div class="container mt-4">
        <h1 class="row new-flats-row">Аренда недвижимости</h1>

        <div class="row mt-4">
            <div class="col-md-4 p-0">
                <form action="{{ route('flat-search') }}" class="flat-search-border px-2 py-4 m-0-10">

                    <span class="flat-search-text">Найти</span>

                    @if($request->order)
                        <input type="hidden" name="order" value="{{ $request->order }}">
                    @endif
                    <div class="w-100 mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="type_of_premises"
                                   id="inlineRadio2" value="Комната" checked>
                            <label class="form-check-label" for="inlineRadio2">Комната</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="type_of_premises"
                                   id="inlineRadio3" value="Квартира" >
                            <label class="form-check-label" for="inlineRadio3">Квартира</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="type_of_premises"
                                   id="inlineRadio1" value="Частный дом">
                            <label class="form-check-label" for="inlineRadio1">Дом</label>
                        </div>
                    </div>

                    <div class="form-group my-4">
                        <input type="text" class="form-control to-check" name="city" placeholder="Город">
                    </div>

                    <div class="form-group mt-2 flex">
                        <div class="search-div-size-half">
                            <input type="text" class="form-control to-check" name="price_start" placeholder="Цена от">
                        </div>
                        <span class="mx-2 my-auto">-</span>
                        <div class="search-div-size-half">
                            <input type="text" class="form-control to-check" name="price_end" placeholder="до">
                        </div>
                        <span class="ml-2 my-auto">₽</span>
                    </div>

                    <div class="w-100 mt-4 mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="rental_period"
                                   id="rental-period1" value="Посуточно" checked>
                            <label class="form-check-label" for="rental-period1">Посуточно</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="rental_period"
                                   id="rental-period2" value="Помесячно">
                            <label class="form-check-label" for="rental-period2">Помесячно</label>
                        </div>
                    </div>

                    <span class="mt-4">Количество комнат:</span>

                    <div class="w-100 mt-2 number-of-rooms">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="number_of_rooms"
                                   id="number-of-rooms1" value="1" checked>
                            <label class="form-check-label" for="number-of-rooms1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="number_of_rooms"
                                   id="number-of-rooms2" value="2">
                            <label class="form-check-label" for="number-of-rooms2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="number_of_rooms"
                                   id="number-of-rooms3" value="3">
                            <label class="form-check-label" for="number-of-rooms3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input to-check" type="radio" name="number_of_rooms"
                                   id="number-of-rooms4" value="4+">
                            <label class="form-check-label" for="number-of-rooms4">4+</label>
                        </div>
                    </div>

                    <div class="form-group mb-0 flex mt-4">
                        <button type="submit" class="mr-1 btn auth-button btn-forgot-password">
                            НАЙТИ
                        </button>
                        <a href="{{ route('flat-search') }}" class="ml-1 btn auth-button ">
                            ОЧИСТИТЬ
                        </a>
                    </div>

                </form>
            </div>
            <div class="col-md-8 ">

                <div class="row flat-sort padding-side-5">
                    @php
                        $filter = [
                            'city' => $request->city,
                            'price_start' => $request->price_start,
                            'price_end' => $request->price_end,
                            'type_of_premises' => $request->type_of_premises,
                            'rental_period' => $request->rental_period,
                            'number_of_rooms' => $request->number_of_rooms,
                        ]
                    @endphp
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'new')
                        <a href="{{ route('flat-search', $filter) }}">Новые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'price_asc')
                        <a href="{{ route('flat-search', $filter) }}">Цена (от самой низкой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'popular_desc')
                        <a href="{{ route('flat-search', $filter) }}">Самые популярные</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'last')
                        <a href="{{ route('flat-search', $filter) }}">Старые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'price_desc')
                        <a href="{{ route('flat-search', $filter) }}">Цена (от самой высокой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'popular_asc')
                        <a href="{{ route('flat-search', $filter) }}">Наименее популярные</a>
                    </div>
                </div>

                <div class="row search-flats mt-3">
                    @for($i=0; $i<2; $i++)
                        @break(!$flats[$i])
                        <div class="col-md-6 one-flat p-0">
                            <a href="{{ route('flat-page', ['id' => $flats[$i]->id]) }}">
                            <img src="{{ asset('/storage/' .  explode("\"", $flats[$i]->photos)[1]) }}" alt="">
                                <div class="search-flat-name px-4">
                                    <span>{{ $flats[$i]->type_of_premises }}, ул. {{ $flats[$i]->street }}, {{ $flats[$i]->house_number }}, {{ $flats[$i]->city }}, сдача {{ $flats[$i]->rental_period }}</span>
                                </div>
                            </a>
                            <div class="row flat-search-flats-param">
                                <div
                                    class="col-md-2 border-right border-secondary text-center">{{ $flats[$i]->number_of_rooms }}
                                    <br> комн.
                                </div>
                                <div
                                    class="col-md-3 border-right border-secondary text-center">{{ $flats[$i]->living_area }}
                                    <br> кв. м.
                                </div>
                                <div class="col-md-3 border-right border-secondary text-center">{{ $flats[$i]->floor }}
                                    <br> этаж
                                </div>
                                <div
                                    class="col-md-4 border-right border-secondary text-center font-weight-bold align-middle">
                                    <span class="align-middle">{{ $flats[$i]->price }} ₽</span></div>
                            </div>
                        </div>
                    @endfor
                </div>
                @if(!count($flats))
                    <h2 class="mt-5 text-secondary text-center">НИЧЕГО НЕ НАЙДЕНО</h2>
                @endif

            </div>

        </div>

        <div class="row mt-5 search-flats mb-2">
            @for($i=2; $i< count($flats); $i++)
                <div class="col-md-4 one-flat p-0 mb-2">
                    <a href="{{ route('flat-page', ['id' => $flats[$i]->id]) }}">
                        <img src="{{ asset('/storage/' .  explode("\"", $flats[$i]->photos)[1]) }}" alt="">
                        <div class="search-flat-name px-4">
                            <span>{{ $flats[$i]->type_of_premises }}, ул. {{ $flats[$i]->street }}, {{ $flats[$i]->house_number }}, {{ $flats[$i]->city }}, сдача {{ $flats[$i]->rental_period }}</span>
                        </div>
                    </a>
                    <div class="row flat-search-flats-param">
                        <div
                            class="col-md-2 border-right border-secondary text-center">{{ $flats[$i]->number_of_rooms }}
                            <br> комн.
                        </div>
                        <div class="col-md-3 border-right border-secondary text-center">{{ $flats[$i]->living_area }}
                            <br> кв. м.
                        </div>
                        <div class="col-md-3 border-right border-secondary text-center">{{ $flats[$i]->floor }} <br>
                            этаж
                        </div>
                        <div class="col-md-4 border-right border-secondary text-center font-weight-bold align-middle">
                            <span class="align-middle">{{ $flats[$i]->price }} ₽</span></div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="row justify-content-center mb-2 mt-4">
            {{ $flats->links() }}
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
