@extends('layouts.personal')

@section('personal-content')
    @include('dialog.part.show', ['dialog' => $dialog, 'section' => 'personal-content'])
@endsection

@section('main-class') col-md-7 @endsection

@section('right-bar')
    <div class="col-md-2">

        <div class="w-100 border-left border-primary h-100 mr-md-1">
            <form action="" method="post" class=" color-bg-dark-blue w-100 text-center">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРИНЯТЬ</button>
            </form>
            <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТКЛОНИТЬ</button>
            </form>
            <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>
            </form>
            <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">УТВЕРДИТЬ</button>
            </form>
            <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-100 text-center">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРОЕКТ ВЫПОЛНЕН</button>
            </form>
        </div>

    </div>
@endsection
