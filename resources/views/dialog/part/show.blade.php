@extends('layouts.app')

@section($section)
{{--        @dump($dialog)--}}
            <div>
                <div class=" row my-md-3 pb-md-2 border-bottom border-primary" style="margin-right: 15px;">
                    <div class=" row w-100 justify-content-between">
                        <div class="row pl-md-5">
                            <img class="personal-area-dialog-img"
                                 src="{{ asset('/storage/' . $dialog->second_user->avatar) }}" alt="">
                            <div class="my-md-auto ml-md-2 ">
                                <div class="font-18-px font-weight-bold">
                                    {{ $dialog->second_user->name . " " . $dialog->second_user->last_name }}
                                </div>
                                <div class="text-secondary">
                                    {{ $dialog->type }}
                                </div>
                            </div>
                        </div>
                        <div class="float-right my-md-auto">
                            ПРОЕКТ ЗАВЕРШЕН
                        </div>
                    </div>
                </div>
                <div class="messages">
                    <div class="first-user-message row mt-md-2  text-white">
                        <span class="bg-primary px-md-2 border rounded">
                            {{ $dialog->messages->last()->message }}
                        </span>
{{--                        {{ Auth::id() == $message->user_id }}--}}
                    </div>
                    <div class="second-user-message row mt-md-2  text-white float-right" style="margin-right: 15px;">
                        <span class="color-bg-dark-blue px-md-2 border rounded">
                            {{ $dialog->messages->last()->message }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="footer">
                qwueqwouio
            </div>
{{--            <div class="col-md-4 border-left border-primary h-100">--}}
{{--                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-50 text-center">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРИНЯТЬ</button>--}}
{{--                </form>--}}
{{--                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-50 text-center">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТКЛОНИТЬ</button>--}}
{{--                </form>--}}
{{--                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-50 text-center">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ОТОЗВАТЬ</button>--}}
{{--                </form>--}}
{{--                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-50 text-center">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">УТВЕРДИТЬ</button>--}}
{{--                </form>--}}
{{--                <form action="" method="post" class="mt-md-2 color-bg-dark-blue w-50 text-center">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="_method" value="PATCH">--}}
{{--                    <button type="submit" class="color-bg-dark-blue text-white border-0 py-md-2">ПРОЕКТ ВЫПОЛНЕН</button>--}}
{{--                </form>--}}
{{--            </div>--}}

@endsection
