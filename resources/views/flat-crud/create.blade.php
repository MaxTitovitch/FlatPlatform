@extends('layouts.personal')

@section('personal-content')
    <div class="container">
        <div class="text-left mt-md-3 ">
            <h1>
                @if($flat === null)
                    Создать объявление
                @else
                    Редактирование объявления
                @endif
            </h1>
        </div>

        <div class="personal-area-flats">
            <form enctype="multipart/form-data" class="style-reset" action="{{ $flat === null ? route('flats.store') : route('flats.update', ['flat' => $flat->id]) }}" method="POST">
                @if (session('status-error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status-error') }}
                    </div>
                @endif
                @if (session('status-success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status-success') }}
                    </div>
                @endif
                @csrf
                @if($flat !== null)
                    <input type="hidden" name="_method" value="put">
                @endif
                @if($flat === null)
                    @php($flat = new \App\Flat())
                @endif
                <div class="row mt-md-5">
                    <div class="col-md-6 ">
                        <select name="type_of_premises" id="" class="w-100 form-control ">
                            <option {{ $flat->type_of_premises=='Квартира' ? 'selected' : '' }}>Квартира</option>
                            <option {{ $flat->type_of_premises=='Частный дом' ? 'selected' : '' }}>Частный дом</option>
                            <option {{ $flat->type_of_premises=='Комната' ? 'selected' : '' }}>Комната</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="rental_period" id="" class="w-100  form-control">
                            <option value="Помесячно" selected>Помесячно</option>
                            <option value="Посуточно">Посуточно</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-md-4">
                    <div class="col-md-4 ">
                        <input name="city" class="form-control w-100  @error('city') is-invalid @enderror" type="text"
                               placeholder="Город" value="{{ $flat->city }}" required>
                    </div>
                    @error('city')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-md-4 ">
                        <input name="street" class="form-control w-100  @error('street') is-invalid @enderror"
                               type="text"
                               placeholder="Улица" value="{{ $flat->street }}" required>
                    </div>
                    @error('street')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-md-4 ">
                        <input name="house_number"
                               class="form-control w-100  @error('house_number') is-invalid @enderror"
                               type="number" placeholder="Номер дома" value="{{ $flat->house_number }}" required>
                    </div>
                    @error('house_number')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mt-md-4">
                    <div class="col-md-3 ">
                        <input name="floor" class="form-control w-100  @error('floor') is-invalid @enderror"
                               type="number"
                               placeholder="Этаж" value="{{ $flat->floor }}" required>
                    </div>
                    @error('floor')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-md-3 ">
                        <input name="number_of_rooms" class="form-control w-100  @error('number_of_rooms') is-invalid @enderror"
                               type="number"
                               placeholder="Кол-во комнат" value="{{ $flat->number_of_rooms }}" required>
                    </div>
                    @error('number_of_rooms')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-md-3 ">
                        <input name="area" class="form-control w-100  @error('area') is-invalid @enderror"
                               type="number" placeholder="Общая площадь" value="{{ $flat->area }}" required>
                    </div>
                    @error('area')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-md-3 ">
                        <input name="living_area" class="form-control w-100  @error('living_area') is-invalid @enderror"
                               type="number" placeholder="Жилая площадь" value="{{ $flat->living_area }}" required>
                    </div>
                    @error('living_area')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mt-md-4 mb-md-4">
                    <div class="col-md-12">
                        <textarea name="description" style="height: 200px" class="form-control w-100  @error('description') is-invalid @enderror"
                               type="text" placeholder="Описание"  required>{{ $flat->description }}</textarea>
                    </div>
                </div>
                @error('description')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror

                <div class="row img-row">
                    @php($photos = explode("\"", $flat->photos))
                    @for($i = 0; $i < count($photos); $i++)
                        @if($i % 2 == 1)
                            <div class="new-flat-main-one col-lg-4 col-xl-4 col-12 col-sm-12 slick-slide-break">
                                <div class="flat-main-img p-2 cross-click">
                                    <section data-action="{{ route('flats.photo-delete', ['id' => $flat->id, 'photo' => ($i+1) / 2]) }}">
                                        @csrf
                                    </section>
                                    <span class="cross">x</span>
                                    <img src="{{asset("/storage/".$photos[$i])}}" alt="">
                                </div>
                            </div>
                        @endif
                    @endfor
                    <div class="display-none template-div new-flat-main-one col-lg-4 col-xl-4 col-12 col-sm-12 slick-slide-break">
                        <div class="flat-main-img p-2 cross-click">
                            <section class="none-section"></section>
                            <span class="cross">x</span>
                            <img src="" alt="">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-between my-md-4">
                    <button type="button" class="multiple-btn btn btn-outline-secondary">Загрузить фото</button>
                    <div class="" style="display: flex">
                        <span class="align-middle h-100 mt-md-1 mr-md-2">Р </span>
                          <input name="price" class="form-control w-100  @error('price') is-invalid @enderror"
                               type="number" placeholder="Цена" value="{{ $flat->price }}" required>
                    </div>
                    @error('house_number')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @error('price')
                <span class="invalid-feedback-home" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror

                <input name="photos[]" type="file" class="display-none multiple-files" multiple accept=".jpg, .jpeg, .png, .gif">

                <div class="row justify-content-center my-md-4 personal-area-flat-save-order">
                    <div class="color-bg-dark-blue">
                        <button class="form-control color-bg-dark-blue text-white w-100  px-md-5" type="submit" >Сохранить объявление
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/cruder.js') }}"></script>
@endsection