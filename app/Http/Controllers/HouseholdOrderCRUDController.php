<?php

namespace App\Http\Controllers;

use App\HouseholdServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdOrderCRUDController extends Controller
{

    public function index()
    {
        return view('service-order.index', ['orders' => Auth::user()->household_orders]);
    }

    public function show(HouseholdServiceOrder $householdServiceOrder)
    {
        return view('service-order.show', ['orders' => $householdServiceOrder]);
    }
}
