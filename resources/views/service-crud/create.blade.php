@extends('layouts.personal')

@section('personal-content')
    <div class="container">
        <div class="text-left mt-md-3 ">
            <h1>
                @if($service === null)
                    Создать объявление
                @else
                    Редактирование объявления
                @endif
            </h1>
        </div>

        <div class="personal-area-flats">
            <form class="style-reset" action="{{ $service === null ? route('household_services.store') : route('household_services.update', ['household_service' => $service->id]) }}" method="POST">
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
                @if($service !== null)
                    <input type="hidden" name="_method" value="put">
                @endif
                @if($service === null)
                    @php($service = new \App\HouseholdService())
                @endif
                <div class="row mt-md-5">
                    <div class="col-md-6 ">
                        <div class="">
                            <input name="title" class="form-control w-100  @error('title') is-invalid @enderror" type="text"
                                   placeholder="Введите заголовок" value="{{ $service->title }}" required>
                        </div>
                        @error('title')
                        <span class="invalid-feedback-home" role="alert">
                            <strong>Введите корректное название</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <select name="household_service_category_id" id="" class="w-100  form-control">
                            @foreach(\App\HouseholdServiceCategory::all() as $category)
                                @if($service->category)
                                    <option {{ $service->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name}}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name}}</option>
                                @endif

                            @endforeach
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
                            <strong>Введите корректный город</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="" style="display: flex">
                            <span class="align-middle h-100 mt-md-1 mr-md-2">Р </span>
                            <input name="price" class="form-control w-100  @error('price') is-invalid @enderror"
                                   type="number" placeholder="Цена" value="{{ $service->price }}" required>
                        </div>
                        @error('price')
                        <span class="invalid-feedback-home" role="alert">
                            <strong>Введите корректную цену</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-md-4 mb-md-4">
                    <div class="col-md-12">
                        <textarea name="description" style="height: 200px"
                                  class="form-control w-100  @error('description') is-invalid @enderror"
                                  type="text" placeholder="Описание" required>{{ $service->description }}</textarea>
                    </div>
                    @error('description')
                    <span class="invalid-feedback-home" role="alert">
                            <strong>Введите корректное описание</strong>
                        </span>
                    @enderror
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
