<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use Illuminate\Support\Facades\Auth;
use App\FlatServiceOrder;
use App\Http\Requests\DateRequest;

class FlatController extends Controller
{
    public function index($id) {
        $flat = Flat::find($id);
        if($flat != null) {
            $dates = $flat->calculateReservedDates();
            return view('flat.index', ['flat' => $flat, 'dates' => $dates]);
        } else {
            return redirect()->route('index');
        }
    }

    public function search(Request $request) {
        $flats = Flat::filtrateFlat($request, 20);
        return view('flat.search', ['flats' => $flats]);
    }

    public function addRequest(DateRequest $request, $id) {
        $user = Auth::user(); $flat = Flat::find($id);
        if(!$user || !$flat) {
            $request->session()->flash('status-error', 'Пользователь не зарегестрирован!');
        } elseif($user->role->name !== 'tenant') {
            $request->session()->flash('status-error', 'Вы не арендатор!');
        } else {
            FlatServiceOrder::create([
                'price' => $flat->price,
                'landlord_confirmation' => 0,
                'tenant_confirmation' => 0,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'status' => 'Создан',
                'tenant_id' => $user->id,
                'flat_id' => $id,
            ]);
            $request->session()->flash('status-success', 'Заявка на квартиру добавлена!');
        }

        return redirect()->route('flat-page', ['id' => $id]);
    }

    public function acceptRequest(Request $request, $id) {
        return $this->patchStatus($request, $id, 'Принят', 'Вы не владелец квартиры!','Заявка на квартиру принята!', 'landlord');
    }

    public function rejectRequest(Request $request, $id) {
        if(Auth::user()->role === 'tenant') {
            return $this->patchStatus($request, $id, 'Отозван', 'Вы не владелец заявки!', 'Заявка на квартиру отозвана!', 'tenant');
        } else {
            return $this->patchStatus($request, $id, 'Отменён', 'Вы не владелец квартиры!', 'Заявка на квартиру отклонена!', 'landlord');
        }
    }

    private function patchStatus(Request $request, $id, $status, $messageError, $messageSuccess, $userType) {
        $user = Auth::user(); $flatOrder = FlatServiceOrder::find($id);
        if(!$user || !$flatOrder) {
            $request->session()->flash('status-error', 'Пользователь не авторизован в системе!');
        } elseif($user->id !== $flatOrder->$userType->id) {
            $request->session()->flash('status-error', $messageError);
        } else {
            $flatOrder->status = $status;
            $flatOrder->save();
            $request->session()->flash('status-success', $messageSuccess);
        }

        return redirect()->route('flat-page', ['id' => $flatOrder->flat->id]);
    }
}
