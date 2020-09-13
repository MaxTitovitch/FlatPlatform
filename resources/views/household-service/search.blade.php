@extends('layouts.app')

@section('content')
    <div class="container mt-4 mb-3">
        <h1 class="row new-flats-row">Поиск хозработника</h1>

        <div class="row mt-4">
            <div class="col-md-4 p-0">
                <form action="{{ route('household-service-search') }}" class="flat-search-border px-2 py-4 m-0-10">

                    @if($request->order)
                        <input type="hidden" name="order" value="{{ $request->order }}">
                    @endif

                    <span class="flat-search-text">Найти</span>

                    <div class="form-group my-4">
                        <input type="text" class="form-control" name="query_string" placeholder="Что нужно найти?">
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

                    <div class="form-group">
                        <select class="form-control" id="category-select" name="category">
                            <option value="" disabled selected>Категория</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-0 flex mt-4">
                        <button type="submit" class="mr-1 btn auth-button btn-forgot-password">
                            НАЙТИ
                        </button>
                        <a href="{{ route('household-service-search') }}" class="ml-1 btn auth-button ">
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
                        <a href="{{ route('household-service-search', $filter) }}">Новые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'price_asc')
                        <a href="{{ route('household-service-search', $filter) }}">Цена (от самой низкой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'popular_desc')
                        <a href="{{ route('household-service-search', $filter) }}">Самые популярные</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'last')
                        <a href="{{ route('household-service-search', $filter) }}">Старые предложения</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'price_desc')
                        <a href="{{ route('household-service-search', $filter) }}">Цена (от самой высокой)</a>
                    </div>
                    <div class="col-md-4 pt-2 pb-2 pathable-search text-center">
                        @php($filter['order'] = 'popular_asc')
                        <a href="{{ route('household-service-search', $filter) }}">Наименее популярные</a>
                    </div>
                </div>

                <div class="row mt-5 search-flats mb-2">
                    @for($i=0; $i<2; $i++)
                        @break(!$householdServices[$i])
                        <div class="new-household-main-one col-md-6">
                            <div class="row">
                                <div class="new-household-main-img mt-3 col-md-5">
                                    <a href="{{ route('household-service-page', [$householdServices[$i]->id]) }}">
                                        <img src="{{asset('/storage/' . $householdServices[$i]->user->avatar)}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <div class="new-household-main-type mb-1">
                                        <a href="{{ route('household-service-page', [$householdServices[$i]->id]) }}">
                                            <span>{{$householdServices[$i]->title}}</span>
                                        </a>
                                    </div>
                                    <div class="new-household-main-name mb-1 font-weight-bold">
                                        <span>{{ $householdServices[$i]->user->name}}</span>
                                    </div>
                                    <div class="new-household-main-name mb-1 text-grey">
                                        <span>{{ $householdServices[$i]->category->name}}</span>
                                    </div>
                                    <div class="new-household-main-price">
                                        <span>{{ $householdServices[$i]->price}} $</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="new-household-main-description mt-3 col-md-12">
                                    <span>{{ $householdServices[$i]->description}}</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                @if(!count($householdServices))
                    <h2 class="mt-5 text-secondary text-center">НИЧЕГО НЕ НАЙДЕНО</h2>
                @endif

            </div>

            <div class="row mt-5 search-flats mb-2">
                @for($i=2; $i< count($householdServices); $i++)
                @break(!$householdServices[$i])
                    <div class="new-household-main-one col-md-4">
                        <div class="row">
                            <div class="new-household-main-img mt-3 col-md-5">
                                <a href="{{ route('household-service-page', [$householdServices[$i]->id]) }}">
                                    <img src="{{asset('/storage/' . $householdServices[$i]->user->avatar)}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <div class="new-household-main-type mb-1">
                                    <a href="{{ route('household-service-page', [$householdServices[$i]->id]) }}">
                                        <span>{{$householdServices[$i]->title}}</span>
                                    </a>
                                </div>
                                <div class="new-household-main-name mb-1 font-weight-bold">
                                    <span>{{ $householdServices[$i]->user->name}}</span>
                                </div>
                                <div class="new-household-main-name mb-1 text-grey">
                                    <span>{{ $householdServices[$i]->category->name}}</span>
                                </div>
                                <div class="new-household-main-price">
                                    <span>{{ $householdServices[$i]->price}} $</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="new-household-main-description mt-3 col-md-12">
                                <span>{{ $householdServices[$i]->description}}</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="row justify-content-center mb-2 mt-4">
            {{ $householdServices->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection