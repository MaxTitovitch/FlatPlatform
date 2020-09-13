@extends('layouts.app')

@section($section)
    <div class="text-center mt-md-3">
        <h1>Диалоги</h1>
    </div>

    @foreach($dialogs as $dialog)
        <div class="row dialog-list-one my-md-4 href-dialog" data-href="{{ route($route, ['id' => $dialog->id]) }}">
            <div class="col-md-2 h-100">
                @if($dialog->first_user_id === Auth::id())
                    @php($otherUser = $dialog->second_user)
                @else
                    @php($otherUser = $dialog->first_user)
                @endif
                <a href="{{ route($route, ['id' => $dialog->id]) }}">
                    @if($dialog->type === 'Поддержка')
                        <img src="{{ asset('img/avatar.png') }}" alt="" class="rounded-circle w-100 h-100">
                    @else
                        <img src="{{ asset('/storage/' . $otherUser->avatar ) }}" alt="" class="rounded-circle w-100 h-100">
                    @endif
                </a>
            </div>
            <div class="col-md-9">
                <p>
                    <a href="{{ route($route, ['id' => $dialog->id]) }}" class="color-dark-blue font-18-px font-weight-bold">
                        @if($dialog->type === 'Поддержка')
                            Варендуру - Техподдержка
                        @else
                            {{ $otherUser->name . " " . $otherUser->last_name }}
                        @endif
                    </a>
                    <br>
                    <a href="{{ route($route, ['id' => $dialog->id]) }}" class="text-decoration-none text-dark">{{ $dialog->messages->last()->message }}</a>
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
@endsection




