<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use Illuminate\Support\Facades\Auth;
use App\FlatServiceOrder;
use App\Http\Requests\DateRequest;

class FlatController extends Controller
{
    public function index(Request $request, $id) {
        $flat = Flat::find($id);
        if($flat != null) {
            $dates = $this->calculateReservedDates($flat->orders);
            return view('flat.index', ['flat' => $flat, 'dates' => $dates]);
        } else {
            return redirect()->route('index');
        }
    }

    public function search(Request $request) {
        $query = $this->addSearchQuery($request, Flat::where('id', '<>', 0));
        $query = $this->addSortQuery($request, $query);
        $flats = $query->paginate(20);
        $flats->withPath($request->getRequestUri());
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

    private function addSearchQuery(Request $request, $query) {
        if($request->city) {
            $query = $query->where('city', 'like', "%{$request->city}%" );
        }
        if($request->price_start) {
            $query = $query->where('price', '>=', $request->price_start );
        }
        if($request->price_end) {
            $query = $query->where('price', '<=', $request->price_end );
        }
        if($request->type_of_premises) {
            $query = $query->where('type_of_premises', $request->type_of_premises );
        }
        if($request->rental_period) {
            $query = $query->where('rental_period', $request->rental_period );
        }
        if($request->number_of_rooms) {
            $query = $query->where('number_of_rooms', $request->number_of_rooms );
        }
        return $query;
    }

    private function addSortQuery(Request $request, $query) {
        if($request->order === 'new') {
            $query = $query->orderBy('id', 'desc');
        }
        if($request->order === 'last') {
            $query = $query->orderBy('id', 'asc');
        }
        if($request->order === 'price_asc') {
            $query = $query->orderBy('price', 'asc');
        }
        if($request->order === 'price_desc') {
            $query = $query->orderBy('price', 'desc');
        }
        if($request->order === 'popular_asc') {
            $query = $query->withCound('orders')->orderBy('orders_count', 'asc');
        }
        if($request->order === 'popular_desc') {
            $query = $query->withCound('orders')->orderBy('orders_count', 'desc');
        }
        return $query;
    }

    private function calculateReservedDates($orders) {
        foreach ($orders as $order) {

        }
    }
}
