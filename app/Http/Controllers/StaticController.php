<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\HouseholdService;
use App\User;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserSupport;

class StaticController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'flats' => Flat::orderBy('updated_at', 'desc')->limit(8)->get(),
            'services' => HouseholdService::orderBy('updated_at', 'desc')->limit(8)->get(),
            'statistic' => $this->calculateStatistic()
        ]);
    }

    public function preregister()
    {
        return view('auth.preregister');
    }

    public function about()
    {
        return view('about');
    }

    public function aboutSave(MailRequest $request)
    {
//        Mail::send(
//            'maxtitovitch@mail.ru' ,
//            'Новое сообщение: Варендуру' ,
//            `<b>Поступило сообщение от:</b>{$request->name} ({$request->email})<br><b>Тема:</b>{$request->theme}<br><b>Сообщение:</b><br>{$request->text}`
//        );
        Mail::to(User::where('role_id', 1)->first())->send(new UserSupport($request));
        Session::flash('status', 'Сообщение успешно отправлено администрации!');
        return redirect()->route('about');
    }

    public function rules()
    {
        return view('rules');
    }

    private function calculateStatistic()
    {
        return [
            'flatsQuantity' => [
                'value' => Flat::where('type_of_premises', 'Квартира')->orWhere('type_of_premises', 'Комната')->count(). ' квартир',
                'text' => 'сдаётся<br>посуточно и<br>помесячно'
            ],
            'housesQuantity' => [
                'value' => Flat::where('type_of_premises', 'Частный дом')->count()  . ' домов',
                'text' => 'сдаётся<br>на данный<br>момент'
            ],
            'servicesQuantity' => [
                'value' => HouseholdService::count() . ' предложений',
                'text' => 'размещено специалистам<br>на сайте'
            ],
            'usersQuantity' => [
                'value' => User::count() . ' работников',
                'text' => 'готовы к<br>выполнению заказов'
            ]
        ];
    }
}
