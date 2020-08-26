<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use Illuminate\Support\Facades\Auth;
use App\FlatServiceOrder;
use App\Http\Requests\DateRequest;
use App\Dialog;
use App\Http\Requests\FlatRequest;

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
        if(!$flat) {
            return redirect()->route('index');
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
        return $this->patchStatus(
            $request,
            $id,
            'Принят',
            'Вы не владелец квартиры!',
            'Заявка на квартиру принята!',
            'landlord',
            function ($flatOrder, $request, $messageError) {
                $dialog = Dialog::create([
                    'first_user_id' => $flatOrder->landlord,
                    'second_user_id' => $flatOrder->tenant,
                    'type' => 'Квартира',
                    'flat_order_id' => $flatOrder->id
                ]);
                $dialog->save();
                return redirect()->route('dialog-show', ['id' => $dialog->id]);
            }
        );
    }

    public function confirmRequest(Request $request, $id) {
        return $this->patchStatus(
            $request,
            $id,
            'Принят',
            'Вы не участник сделки!',
            'Условия приняты!',
            Auth::user()->role,
            function ($flatOrder, $request, $messageError) {
                if(Auth::user()->role === 'tenant') {
                    $flatOrder->tenant_confirmation = 1;
                } else {
                    $flatOrder->landlord_confirmation = 1;
                }
                if($flatOrder->tenant_confirmation && $flatOrder->landlord_confirmation) {
                    $flatOrder->status = 'Утверждён';
                }
                $flatOrder->save();
                return redirect()->route('dialog-show', ['id' => $flatOrder->dialogs->first()->id]);
            }
        );
    }

    public function completeRequest(Request $request, $id) {
        return $this->patchStatus(
            $request,
            $id,
            'Выполнен',
            'Вы не арендодатель!',
            'Сделка выполнена!',
            'landlord',
            function ($flatOrder, $request, $messageError) {
                if($flatOrder->tenant_confirmation && $flatOrder->landlord_confirmation && $flatOrder->status == 'Утверждён') {
                    $flatOrder->status = 'Выполнен';
                    $flatOrder->save();
                } else {
                    $request->session()->forget('status-success');
                    $request->session()->flash('status-error', $messageError);
                }
                return redirect()->route('dialog-show', ['id' => $flatOrder->dialogs->first()->id]);
            }
        );
    }

    public function rejectRequest(Request $request, $id) {
        if(Auth::user()->role === 'tenant') {
            return $this->patchStatus($request, $id, 'Отозван', 'Вы не владелец заявки!', 'Заявка на квартиру отозвана!', 'tenant');
        } else {
            return $this->patchStatus($request, $id, 'Отменён', 'Вы не владелец квартиры!', 'Заявка на квартиру отклонена!', 'landlord');
        }
    }

    public function updateRequest(FlatRequest $request, $id) {
        $user = Auth::user(); $flatOrder = FlatServiceOrder::find($id);
        if(!$flatOrder || $user->role->name !== 'landlord') {
            $request->session()->flash('status-error', 'Вы не имеете доступа к данному действию!');
            return redirect()->route('index');
        } else {
            $flatOrder->update($request->all());
            $request->session()->flash('status-success', 'Заявка на квартиру обновлена!');
            return redirect()->route('dialog-show', ['id' => $flatOrder->dialog->id]);
        }
    }

    private function patchStatus(Request $request, $id, $status, $messageError, $messageSuccess, $userType, $callback = null) {
        $user = Auth::user(); $flatOrder = FlatServiceOrder::find($id);
        if(!$flatOrder) {
            return redirect()->route('index');
        } elseif($user->id !== $flatOrder->$userType->id) {
            $request->session()->flash('status-error', $messageError);
        } else {
            $flatOrder->status = $status;
            $flatOrder->save();
            $request->session()->flash('status-success', $messageSuccess);
        }
        if(is_callable($callback)) {
            return $callback($flatOrder, $request, $messageError);
        } else {
            return redirect()->route('flat-page', ['id' => $flatOrder->flat->id]);
        }
    }
}