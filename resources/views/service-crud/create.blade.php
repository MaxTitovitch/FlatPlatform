@extends('layouts.personal')

@section('personal-content')
    {{--    <div>--}}
    {{--        @dd($service)--}}
    {{--    </div>--}}

    <div class="container">
        <div class="text-left mt-md-3 ">
            <h1>Редактирование объявления</h1>
        </div>

        <div class="personal-area-flats">
            <form action="">

                <div class="row mt-md-5">
                    <div class="col-md-6 ">
                        <div class="">
                            <input name="title" class="form-control w-100  @error('city') is-invalid @enderror" type="text"
                                   placeholder="Введите заголовок" value="{{ $service->title }}" required>
                        </div>
                        @error('city')
                        <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <select name="category" id="" class="w-100  form-control">
                            <option {{ $service->category->name == 'Сантехника'? 'selected' : '' }}>Сантехника</option>
                            <option {{ $service->category->name == 'Электрика'? 'selected' : '' }}>Электрика</option>
                            <option {{ $service->category->name == 'Уборка'? 'selected' : '' }}>Уборка</option>
                            <option {{ $service->category->name == 'Помощь по дому'? 'selected' : '' }}>Помощь по дому</option>
                            <option {{ $service->category->name == 'Работа с газом'? 'selected' : '' }}>Работа с газом</option>
                            <option {{ $service->category->name == 'Дезинфекция'? 'selected' : '' }}>Дезинфекция</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-md-3">
                    <div class="col-md-6 ">
                        <div class="">
                            <input name="city" class="form-control w-100  @error('city') is-invalid @enderror" type="text"
                                   placeholder="Введите заголовок" value="{{ $service->city }}" required>
                        </div>
                        @error('city')
                        <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="" style="display: flex">
                            <span class="align-middle h-100 mt-md-1 mr-md-2">Р </span>
                            <input name="price" class="form-control w-100  @error('price') is-invalid @enderror"
                                   type="number" placeholder="Цена" value="{{ $service->price }}" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-md-4 mb-md-4">
                    <div class="col-md-12">
                        <textarea name="description" style="height: 200px"
                                  class="form-control w-100  @error('description') is-invalid @enderror"
                                  type="text" placeholder="Описание" required>{{ $service->description }}</textarea>
                    </div>
                </div>
                @error('description')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror

                <div class="row">
                    @php($photos = explode("\"", $service->photos))
                    @for($i = 0; $i < count($photos); $i++)
                        @if($i % 2 == 1)
                            <div class="new-flat-main-one col-lg-4 col-xl-4 col-12 col-sm-12 slick-slide-break">
                                <div class="flat-main-img p-2">
                                    <span class="cross">x</span>
                                    <img src="{{asset("/storage/".$photos[$i])}}" alt="">
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>



                <div class="row justify-content-center my-md-4 personal-area-flat-save-order">
                    <div class="color-bg-dark-blue">
                        <button class="form-control color-bg-dark-blue text-white w-100  px-md-5"
                                type="submit">Сохранить объявление
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
