@extends('layouts.app')

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
@endsection

@section('content')
    <div class="container mt-3 mb-4">
        <span class="new-flats-row department ">О нас</span>

        <div class="row justify-content-center">
            <span class="about-information">ИНФОРМАЦИЯ О КОМПАНИИ</span>
        </div>

        <div class="mt-4">
            <span class="">
                Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году. Компания ВАРЕНДУРУ зарегистрирована в России в 2020 году.
            </span>
        </div>

        <div class="row justify-content-center mt-4">
            <span class="about-information">ЦЕЛИ</span>
        </div>

        <div class="mt-4">
            <span class="">
             Нам важно видеть в каждом не просто очередного клиента, а индивидуальность с уникальными желаниями. <br><br> Цель ВАРЕНДУРУ — быть той компанией, которую Вы с радостью посоветуете своим близким и друзьям.
            </span>
        </div>

        <div class="row justify-content-center mt-5">
            <span class="about-information">КОНТАКТНЫЕ ДАННЫЕ</span>
        </div>

        <div class="mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="about-phone">
                        <div><i class="fa fa-phone fa-2x bg-primary text-white" aria-hidden="true"></i></div>
                        <div class="ml-3">
                            <strong>
                                Телефон:
                            </strong><br>
                            +7(911)000-00-00
                        </div>
                    </div>
                    <div class="about-phone mt-2">
                        <div><i class="fa fa-envelope-o fa-2x bg-primary text-white" aria-hidden="true"></i></div>
                        <div class="ml-3">
                            <strong>
                                Электронная почта:
                            </strong> <br>
                            support@varenduru.ru
                        </div>
                    </div>
                    <div class="about-phone mt-2">
                        <div><i class="fa fa-home fa-2x bg-primary text-white" aria-hidden="true"></i></div>
                        <div class="ml-3">
                            <strong>
                                Юридический адрес:
                            </strong> <br>
                            Московская область, <br>
                            г. Подольск, ул. Огородная 5/2
                        </div>
                    </div>

                    <div class="about-contact-us mt-5">
                        <div class="row justify-content-center">
                            <span class="">
                                <strong>Обратная связь</strong>
                            </span>
                        </div>
                    </div>


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form method="POST" action="">

                        <div class="form-group w-100 ">
                            <div>
                                <div class="input-container w-100">
                                    <div class="form-row w-100">
                                        <input id="name" type="text"
                                               class="w-100 text-dark about-border-bottom" name="name"
                                               required autocomplete="current-password" placeholder="Ваше имя">
                                        <label for="name">Ваше имя</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group w-100 ">
                            <div class="input-container w-100">
                                <div class="form-row w-100">
                                    <input id="email" type="email"
                                           class="w-100 text-dark about-border-bottom" name="email"
                                           required autocomplete="current-password" placeholder="Ваше email">
                                    <label for="email">Ваш email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group w-100 ">
                            <div class="input-container w-100">
                                <div class="form-row w-100">
                                    <input id="theme" type="text"
                                           class="w-100 text-dark about-border-bottom" name="theme"
                                           required autocomplete="" placeholder="Тема">
                                    <label for="theme">Тема</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="text" style="font-size: 18px">Сообщение</label>
                        </div>

                        <div class="form-group w-100">
                            <div class="input-container w-100">
                                <div class="w-100">
                                    <textarea id="text" type="text"
                                              class="w-100" name="text" rows="5"
                                              required autocomplete="" placeholder="Сообщение"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-dark">Отправить</button>

                    </form>
                </div>


                <div class="col-md-8">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d75251.037423225!2d27.523305695264433!3d53.88562914528901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbcfbc08fc7133%3A0x6c1ad4b7d5444b49!2z0J_Qu9C-0YnQsNC00Ywg0J_QvtCx0LXQtNGLLCDQnNC40L3RgdC6!5e0!3m2!1sru!2sby!4v1599426512201!5m2!1sru!2sby"
                        width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                        aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>

    </div>



@endsection
