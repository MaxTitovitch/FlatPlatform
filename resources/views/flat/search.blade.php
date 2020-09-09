@extends('layouts.app')

@section('content')
{{--        <div>--}}
{{--            @dd($flats, $flats->links())--}}
{{--        </div>--}}


    <div class="container">
        <h1 class="row new-flats-row">Аренда недвижимости</h1>

        <div class="row">
            <div class="col-md-4 p-0">
                <form action="{{ route('flat-search') }}" class="flat-search-border px-2 py-4 m-0-10">

                    <span class="flat-search-text">Найти</span>

                    <div class="w-100 mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_of_premises"
                                   id="inlineRadio2" value="Комната">
                            <label class="form-check-label" for="inlineRadio2">Комната</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_of_premises"
                                   id="inlineRadio3" value="Квартира">
                            <label class="form-check-label" for="inlineRadio3">Квартира</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_of_premises"
                                   id="inlineRadio1" value="Частный дом" checked>
                            <label class="form-check-label" for="inlineRadio1">Дом</label>
                        </div>
                    </div>

                    <div class="form-group my-4">
                        <input type="text" class="form-control" name="city" placeholder="Город">
                    </div>

                    <div class="form-group mt-2 flex">
                        <div class="search-div-size-half">
                            <input type="text" class="form-control" name="price_start" placeholder="Цена от">
                        </div>
                        <span class="mx-2 my-auto">-</span>
                        <div class="search-div-size-half">
                            <input type="text" class="form-control" name="price_end" placeholder="до">
                        </div>
                        <span class="ml-2 my-auto">P</span>
                    </div>

                    <div class="w-100 mt-4 mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental_period"
                                   id="rental-period1" value="Частный дом" checked>
                            <label class="form-check-label" for="rental-period1">Посуточно</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental_period"
                                   id="rental-period2" value="Квартира">
                            <label class="form-check-label" for="rental-period2">Помесячно</label>
                        </div>
                    </div>

                    <span class="mt-4">Количество комнат:</span>

                    <div class="w-100 mt-2 number-of-rooms">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="number_of_rooms"
                                   id="number-of-rooms1" value="Частный дом" checked>
                            <label class="form-check-label" for="number-of-rooms1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="number_of_rooms"
                                   id="number-of-rooms2" value="Квартира">
                            <label class="form-check-label" for="number-of-rooms2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="number_of_rooms"
                                   id="number-of-rooms3" value="Комната">
                            <label class="form-check-label" for="number-of-rooms3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="number_of_rooms"
                                   id="number-of-rooms4" value="Комната">
                            <label class="form-check-label" for="number-of-rooms4">4+</label>
                        </div>
                    </div>

                    <div class="form-group mb-0 flex mt-4">
                        <button type="submit" class="mr-1 btn auth-button btn-forgot-password">
                            НАЙТИ
                        </button>
                        <button type="submit" class="ml-1 btn auth-button ">
                            ОЧИСТИТЬ
                        </button>
                    </div>


                </form>
            </div>
            <div class="col-md-8 ">

                <div class="row flat-sort padding-side-5">
                    <div class="col-md-4 pt-2 pb-2 selected-sort text-center">
                        <a href="{{ route('flat-search') . "?order=new" }}">Новые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 text-center">
                        <a href="{{ route('flat-search') . "?order=price_asc" }}">Цена (от самой низкой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 text-center">
                        <a href="{{ route('flat-search') . "?order=popular_desc" }}">Самые популярные</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 text-center">
                        <a href="{{ route('flat-search') . "?order=last" }}">Старые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 text-center">
                        <a href="{{ route('flat-search') . "?order=price_desc" }}">Цена (от самой высокой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 text-center">
                        <a href="{{ route('flat-search') . "?order=popular_asc" }}">Наименее популярные</a>
                    </div>
                </div>

                <div class="row search-flats mt-3">
                    @for($i=0; $i<2; $i++)
                    @break(!$flats[$i])
                    <div class="col-md-6 one-flat p-0">
                        <img src="{{ asset('/storage/' .  explode("\"", $flats[$i]->photos)[1]) }}" alt="">
                        <div class="search-flat-name px-4">
                            <span>Квартира, ул. Притыцкого, 152а, Минск, сдача помесячно</span>
                        </div>
                        <div class="row flat-search-flats-param">
                            <div class="col-md-2 border-right border-secondary text-center">2 <br> комн.</div>
                            <div class="col-md-3 border-right border-secondary text-center">90 <br> кв. м.</div>
                            <div class="col-md-3 border-right border-secondary text-center">6 <br> этаж</div>
                            <div class="col-md-4 border-right border-secondary text-center font-weight-bold align-middle">
                                <span class="align-middle">16 000 ₽</span></div>
                        </div>
                    </div>
                    @endfor
                </div>

            </div>

        </div>

        <div class="row mt-5 search-flats mb-2">
            @for($i=2; $i< count($flats); $i++)
                <div class="col-md-4 one-flat p-0 mb-2">
                    <img src="{{ asset('/storage/' .  explode("\"", $flats[$i]->photos)[1]) }}" alt="">
                    <div class="search-flat-name px-4">
                        <span>Квартира, ул. Притыцкого, 152а, Минск, сдача помесячно</span>
                    </div>
                    <div class="row flat-search-flats-param">
                        <div class="col-md-2 border-right border-secondary text-center">2 <br> комн.</div>
                        <div class="col-md-3 border-right border-secondary text-center">90 <br> кв. м.</div>
                        <div class="col-md-3 border-right border-secondary text-center">6 <br> этаж</div>
                        <div class="col-md-4 border-right border-secondary text-center font-weight-bold align-middle">
                            <span class="align-middle">16 000 ₽</span></div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="row justify-content-center mb-2 mt-4">
            {{ $flats->links() }}
        </div>

    </div>

@endsection
