@section($section)
    {{--            @dump($dialog)--}}
    <div class="pa-dialog-footer">
        <div class=" row my-md-3 pb-md-2 border-bottom border-primary" style="margin-right: 15px;">
            <div class=" row w-100 justify-content-between">
                <div class="row pl-md-5">
                    @php
                        $user = $dialog->second_user->id == Auth::id() ? $dialog->first_user : $dialog->second_user
                    @endphp

                    @if($dialog->type === 'Поддержка' && $section != 'content')
                        <img class="personal-area-dialog-img" src="{{ asset('img/avatar.png') }}" alt="">
                    @else
                        <img class="personal-area-dialog-img" src="{{ asset('/storage/' . $user->avatar) }}" alt="">
                    @endif
                    <div class="my-md-auto ml-md-2 ">
                        <div class="font-18-px font-weight-bold">
                            @if($dialog->type === 'Поддержка' && $section != 'content')
                                Варендуру - Техподдержка
                            @else
                                {{ $user->name . " " . $user->last_name }}
                            @endif
                        </div>
                        <div class="text-secondary">
                            {{ $dialog->type }}
                        </div>
                    </div>
                </div>
                <div class="float-right my-md-auto">
                    @if($dialog->household_service_order)
                        ПРОЕКТ {{ mb_strtoupper($dialog->household_service_order->status) }}
                    @elseif($dialog->flat_order)
                        ПРОЕКТ {{ mb_strtoupper($dialog->flat_order->status) }}
                    @endif
                </div>
            </div>
        </div>
        <div class="message-body" data-user-id="{{ Auth::id() }}">
            <div class="display-none display-none2 super-messager get-action-message "
                 data-message-action="{{ route('get-last-messages', ['id' => 'TOREPLACE']) }}">
                <div class="display-none message-user-all first-user-message my-md-1 text-white unread-entity">
                    <span class="bg-primary px-md-2 rounded">
                        Text
                        <span class="message-time">12:02</span>
                    </span>
                </div>
                <div class="display-none message-user-all second-user-message my-md-1 text-white unread-entity"
                     style="margin-right: 15px;">
                    <span class="color-bg-dark-blue px-md-2 rounded">
                        Text
                        <span class="message-time">12:02</span>
                    </span>
                </div>
                <div class="message-user-all no-user-message my-md-1 text-secondary text-center display-none unread-entity">
                    <span class="px-md-2 rounded">
                        Text
                    </span>
                </div>
                @php
                    $newMessages = null; $lastData = null;
                    $messages = \App\Message::where('dialog_id', $dialog->id)->orderBy('created_at', 'asc')->get();
                    $realCount = $messages->count() - $count; $id = 0;
                    if($messages->count() > 20) {
                       $newMessages = collect([
                           $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(),
                           $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(),
                           $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(),
                           $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(),
                           $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(), $messages->pop(),
                       ])->reverse();
                    } else {
                        $newMessages = $messages;
                        $messages = [];
                    }
                @endphp
                @if($messages != [])
                    <details>
                        @foreach($messages as $message)
                            @if($message->type == 'Служебное')
                                <div class="message-user-all no-user-message my-md-1 text-secondary text-center {{ $id >= $realCount ? 'unread-entity' : '' }}" data-idlast="{{ $message->id }}">
                                    <span class="px-md-2 rounded">
                                        {{ $message->message }}
                                    </span>
                                </div>
                                @continue
                            @endif
                            @if($lastData != substr($message->created_at, 0, 10))
                                @php($lastData = substr($message->created_at, 0, 10))
                                <div class="last-data my-4 text-center text-primary w-100">{{ $lastData }}</div>
                            @endif
                            @if(Auth::id() !== $message->user_id)
                                <div class="message-user-all first-user-message my-md-1 text-white {{ $id >= $realCount ? 'unread-entity' : '' }}"
                                     data-idlast="{{ $message->id }}">
                                <span class="bg-primary px-md-2 rounded">
                                    @if($message->type == 'Текст')
                                        {{ $message->message }}
                                    @else
                                        @if(array_search(explode('.', $message->message)[1], ['png', 'git', 'jpeg', 'jpg']) !== false)
                                            <img src="{{ $message->message }}" alt="">
                                        @elseif(array_search(explode('.', $message->message)[1], ['ogv', 'mp4', 'webm']) !== false)
                                            <video src="{{ $message->message }}" controls="controls"></video>
                                        @else
                                            <a target="_blank" download href="{{ $message->message }}"><strong><i>Файл {{ mb_strtoupper(explode('.', $message->message)[1]) }}</i></strong></a>
                                        @endif
                                    @endif
                                    <span class="message-time">{{ substr($message->created_at, 11, 5) }}</span>
                                </span>
                                </div>
                            @else
                                <div class="message-user-all second-user-message my-md-1 text-white {{ $id >= $realCount ? 'unread-entity' : '' }}"
                                     style="margin-right: 15px;" data-idlast="{{ $message->id }}">
                                <span class="color-bg-dark-blue px-md-2 rounded">
                                                                            @if($message->type == 'Текст')
                                        {{ $message->message }}
                                    @else
                                        @if(array_search(explode('.', $message->message)[1], ['png', 'git', 'jpeg', 'jpg']) !== false)
                                            <img src="{{ $message->message }}" alt="">
                                        @elseif(array_search(explode('.', $message->message)[1], ['ogv', 'mp4', 'webm']) !== false)
                                            <video src="{{ $message->message }}" controls="controls"></video>
                                        @else
                                            <a target="_blank" download href="{{ $message->message }}"><strong><i>Файл {{ mb_strtoupper(explode('.', $message->message)[1]) }}</i></strong></a>
                                        @endif
                                    @endif
                                    <span class="message-time">{{ substr($message->created_at, 11, 5) }}</span>
                                </span>
                                </div>
                            @endif
                            @php ($id++)
                        @endforeach
                        <summary class="display-none">Все сообщения</summary>
                    </details>
                    <div class="summary"><a name="scroll">Все сообщения</a></div>
                @endif
                @if($newMessages)
                <!-- png git jpeg jpg - photo  -->
                    <!-- ogv mp4 webm - video  -->
                    <!-- other - other  -->
                    @foreach($newMessages as $message)
                        @if($message->type == 'Служебное')
                            <div class="message-user-all no-user-message my-md-1 text-secondary text-center {{ $id >= $realCount? 'unread-entity' : '' }}" data-idlast="{{ $message->id }}">
                                <span class="px-md-2 rounded">
                                    {{ $message->message }}
                                </span>
                            </div>
                            @continue
                            @continue
                        @endif
                        @if($lastData != substr($message->created_at, 0, 10))
                            @php($lastData = substr($message->created_at, 0, 10))
                            <div class="last-data my-4 text-center text-primary w-100">{{ $lastData }}</div>
                        @endif
                        @if(Auth::id() !== $message->user_id)
                            <div class="message-user-all first-user-message my-md-1 text-white {{ $id >= $realCount ? 'unread-entity' : '' }}"
                                 data-idlast="{{ $message->id }}">
                                <span class="bg-primary px-md-2 rounded">
                                    @if($message->type == 'Текст')
                                        {{ $message->message }}
                                    @else
                                        @if(array_search(explode('.', $message->message)[1], ['png', 'git', 'jpeg', 'jpg']) !== false)
                                            <img src="{{ $message->message }}" alt="">
                                        @elseif(array_search(explode('.', $message->message)[1], ['ogv', 'mp4', 'webm']) !== false)
                                            <video src="{{ $message->message }}" controls="controls"></video>
                                        @else
                                            <a target="_blank" download href="{{ $message->message }}"><strong><i>Файл {{ mb_strtoupper(explode('.', $message->message)[1]) }}</i></strong></a>
                                        @endif
                                    @endif

                                    <span class="message-time">{{ substr($message->created_at, 11, 5) }}</span>
                                </span>
                            </div>
                        @else
                            <div class="message-user-all second-user-message my-md-1 text-white {{ $id >= $realCount ? 'unread-entity' : '' }}"
                                 style="margin-right: 15px;" data-idlast="{{ $message->id }}">
                                <span class="color-bg-dark-blue px-md-2 rounded">

                                    @if($message->type == 'Текст')
                                        {{ $message->message }}
                                    @else
                                        @if(array_search(explode('.', $message->message)[1], ['png', 'git', 'jpeg', 'jpg']) !== false)
                                            <img src="{{ $message->message }}" alt="">
                                        @elseif(array_search(explode('.', $message->message)[1], ['ogv', 'mp4', 'webm']) !== false)
                                            <video src="{{ $message->message }}" controls="controls"></video>
                                        @else
                                            <a target="_blank" download href="{{ $message->message }}"><strong><i>Файл {{ mb_strtoupper(explode('.', $message->message)[1]) }}</i></strong></a>
                                        @endif
                                    @endif

                                    <span class="message-time">{{ substr($message->created_at, 11, 5) }}</span>
                                </span>
                            </div>
                        @endif
                        @php ($id++)
                    @endforeach

                @endif
            </div>
        </div>
        <form id="messageSender" class="footer color-bg-dark-blue w-100 py-md-2 border-bottom border-white"
              action="{{ route('send-message', ['id' => $dialog->id]) }}" method="post">
            @csrf
            <div class="row bg-white mx-md-5  justify-content-center" style="border-radius: 25px">
                <input name="message" type="text" placeholder="Введите сообщение" class="border-0 message-input" autocomplete="off"
                       style="border-radius: 25px; flex: 2; padding: 0 15px;">
                <div class="">
                    <input name="file" type="file" class="display-none">
                    <a class="svg-btn" href="#">
                        <svg width="48" height="47" viewBox="0 0 48 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M22.6272 13.2911L33.8084 24.4723C35.9571 26.621 35.9571 30.1017 33.8084 32.2504C31.6596 34.3992 28.1789 34.3992 26.0302 32.2504L13.8768 20.097C12.5351 18.7553 12.5351 16.5774 13.8768 15.2357C15.2185 13.894 17.3964 13.894 18.7381 15.2357L28.947 25.4445C29.4818 25.9793 29.4818 26.8543 28.947 27.3891C28.4123 27.9238 27.5372 27.9238 27.0025 27.3891L17.7659 18.1525L16.3075 19.6109L25.5441 28.8475C26.8858 30.1892 29.0637 30.1892 30.4054 28.8475C31.7471 27.5058 31.7471 25.3279 30.4054 23.9861L20.1966 13.7773C18.0478 11.6286 14.5671 11.6286 12.4184 13.7773C10.2697 15.926 10.2697 19.4067 12.4184 21.5555L24.5718 33.7089C27.5275 36.6646 32.3111 36.6646 35.2668 33.7089C38.2225 30.7531 38.2225 25.9696 35.2668 23.0139L24.0856 11.8327L22.6272 13.2911Z"
                                    fill="#183E62"/>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="33" height="33" fill="white"
                                          transform="translate(0.751953 23.5) rotate(-45)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
                <input type="submit" class=" mr-md-2 my-md-auto border-0 color-bg-dark-blue text-white px-md-2 py-md-1"
                       style="border-radius: 25px">
            </div>
        </form>
    </div>
@endsection


@if($cssSection)
    @section ($cssSection)
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dialog-admin.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @endsection
@endif


@section ($jsSection)
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"--}}
{{--            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"--}}
{{--            crossorigin="anonymous"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"--}}
{{--            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"--}}
{{--            crossorigin="anonymous"></script>--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('js/dialog.js') }}"></script>
@endsection
