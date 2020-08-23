<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;

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
