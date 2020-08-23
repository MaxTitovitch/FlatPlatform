<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Flat extends Model
{
    protected $fillable = [
        'street', 'house_number', 'description', 'floor', 'area', 'living_area', 'number_of_rooms', 'city', 'type_of_premises', 'rental_period', 'price', 'photos', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\FlatServiceOrder');
    }

    public function service_orders()
    {
        return $this->hasMany('App\HouseholdServiceOrder');
    }


    public function calculateReservedDates() {
        $daysFlat = [];
        $daysService = [];
        $this->calculateOrders($daysFlat);
        $this->calculateServiceOrders($daysService);
        return ['flatDates' => array_unique($daysFlat), 'serviceDates' => array_unique($daysService)];
    }

    private function calculateOrders(&$days) {
        foreach ($this->orders as $order) {
            $days = array_merge($days, $this->calculateDays($order->date_start, $order->date_end));
        }
    }

    private function calculateServiceOrders(&$days) {
        foreach ($this->service_orders as $order) {
            $days = array_merge($days, [$order->date_of_completion]);
        }
    }

    private function calculateDays($date_start, $date_end) {
        $dayInTyme = 86400;
        $date_start = strtotime($date_start);
        $date_end = strtotime($date_end);
        $numDays = round(($date_end - $date_start) / $dayInTyme) + 1;
        $days = [];
        for ($i = 0; $i < $numDays; $i++) {
            $days[] = date('Y-m-d', ($date_start + ($i * $dayInTyme)));
        }
        return $days;
    }

    public static function filtrateFlat(Request $request, $itemPerPage = 20) {
        $query = self::addSearchQuery($request, self::where('id', '<>', 0));
        $query = self::addSortQuery($request, $query);
        $flats = $query->paginate($itemPerPage);
        $flats->withPath($request->getRequestUri());
        return $flats;
    }

    private static function addSearchQuery(Request $request, $query) {
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

    private static function addSortQuery(Request $request, $query) {
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
}
