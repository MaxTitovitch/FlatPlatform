<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\HouseholdService;
use App\User;

class StaticController extends Controller
{
    public function index() {
        return view('welcome', [
            'flats' => Flat::orderBy('updated_at', 'desc')->limit(8)->get(),
            'services' => HouseholdService::orderBy('updated_at', 'desc')->limit(8)->get(),
            'statistic' => $this->calculateStatistic()
        ]);
    }

    public function about() {
        return view('about');
    }

    public function rules() {
        return view('rules');
    }

    private function calculateStatistic() {
        return [
            'flatsQuantity' => [
                'name' => 'Количество квартир',
                'value' => Flat::count()
            ],
            'servicesQuantity' => [
                'name' => 'Количество объявлений о работе',
                'value' => HouseholdService::count()
            ],
            'usersQuantity' => [
                'name' => 'Количество уникальных пользователей',
                'value' => User::count()
            ],
        ];
    }
}
