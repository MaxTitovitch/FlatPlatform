<?php

namespace App\Http\Controllers;

use App\HouseholdServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdOrderCRUDController extends Controller
{

    public function index()
    {
        if(Auth::user()->role->name === 'landlord') {
            $orders = Auth::user()->landlord_household_orders;
        } else {
            $orders = collect([]);
            foreach (Auth::user()->household_services as $services) {
                foreach ($services->orders as $order) {
                    $orders->push($order);
                }
            }
        }
        return view('service-order.index', ['orders' => $orders]);
    }

    public function show(HouseholdServiceOrder $householdServiceOrder)
    {
        return view('service-order.show', ['orders' => $householdServiceOrder]);
    }
}
