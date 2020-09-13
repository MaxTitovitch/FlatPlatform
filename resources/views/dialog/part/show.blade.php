@extends('layouts.app')




@section('content')

{{--    <div>--}}
{{--        @dd($dialog->messages)--}}
{{--    </div>--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">

                <div class="text-center mt-md-3">
                    <h1>Диалоги</h1>
                </div>

                @foreach($dialogs as $dialog)
                    <div class="row dialog-list-one my-md-4">
                        <div class="col-md-2">
                            @if($dialog->first_user_id === Auth::id())
                                @php($otherUser = $dialog->second_user)
                            @else
                                @php($otherUser = $dialog->first_user)
                            @endif
                            <img src="{{ asset('/storage/' . $otherUser->avatar ) }}" alt="" class="rounded-circle w-50 ml-md-5">
                        </div>
                        <div class="col-md-9">
                            <p>
                                <span class="color-dark-blue font-18-px font-weight-bold">{{ $otherUser->name . " " . $otherUser->last_name }}</span>
                                <br>
                                <a href="{{ route('dialog-show', ['id' => $dialog->id]) }}" class="text-decoration-none text-dark">{{ $dialog->messages->last()->message }}</a>
                            </p>
                        </div>
                        <div class="col-md-1">
                            <span class="text-secondary" style="font-size: 12px">
                                {{ explode(" ", $dialog->messages->last()->created_at)[1]  }} <br>
                                {{ $dialog->type }}
                            </span>
                        </div>
                    </div>
                @endforeach

                <div class="row justify-content-center mb-2 mt-4">
                    {{ $dialogs->links() }}
                </div>

            </div>
            <div class="col-md-2">
                <div class="dialog-list-connect-support btn btn-block btn-outline-primary pt-md-3 mt-md-4">
                    <a href="" class="text-primary h-100">
                        Связаться с техподдержкой
                    </a>
                </div>
            </div>
        </div>




    </div>
@endsection
