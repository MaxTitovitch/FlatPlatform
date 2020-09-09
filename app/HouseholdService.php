<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HouseholdService extends Model
{

    protected $fillable = [
        'title', 'city', 'description', 'price', 'user_id', 'household_service_category_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\HouseholdServiceCategory', 'household_service_category_id');
    }

    public function orders()
    {
        return $this->hasMany('App\HouseholdServiceOrder');
    }

    public static function filtrateHouseholdService(Request $request, $itemPerPage = 20)
    {
        $query = self::addSearchQuery($request);
        $query = self::addSortQuery($request, $query);
        $householdServices = $query->paginate($itemPerPage);
        $householdServices->withPath(route('household-service-search', $request->except('page')));
        return $householdServices;
    }

    private static function addSearchQuery($request){
        $query = self::where('household_services.id', '>', 0);
        if ($request->city){
            $query = $query->where('household_services.city', 'like', "%{$request->city}%");
        }
        if ($request->price_start){
            $query = $query->where('household_services.price', '>=', $request->price_start);
        }
        if ($request->price_end){
            $query = $query->where('household_services.price', '<=', $request->price_end);
        }
        if ($request->category){
            $query = $query->join('household_service_categories', 'household_services.household_service_category_id', '=', 'household_service_categories.id')
                ->where('household_service_categories.name', '=', $request->category);
        }
        if ($request->query_string){
            $query = $query->where('household_services.title', 'like', "%{$request->query_string}%")->where('household_services.description', 'like', "%{$request->query_string}%");
        }
        return $query;
    }

    private static function addSortQuery($request, $query){
        switch ($request->order){
            default: case 'new': return $query->orderBy('household_services.id', 'desc');
            case 'last': return $query->orderBy('household_services.id', 'asc');
            case 'price_asc': return $query->orderBy('household_services.price', 'asc');
            case 'price_desc': return $query->orderBy('household_services.price', 'desc');
            case 'popular_asc': return $query->withCount('orders')->orderBy('household_services.orders_count', 'asc');
            case 'popular_desc': return $query->withCount('orders')->orderBy('household_services.orders_count', 'desc');
        }
    }
}
