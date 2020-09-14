<?php

namespace App\Http\Controllers;

use App\FlatServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatOrderCRUDController extends Controller
{
    public function index()
    {
        if(Auth::user()->role->name === 'tenant') {
            $orders = Auth::user()->tenant_flat_orders;
        } else {
            $orders = collect([]);
            foreach (Auth::user()->flats as $flat) {
                foreach ($flat->orders as $order) {
                    $orders->push($order);
                }
            }
        }
        return view('order.index', ['orders' => $orders]);
    }

    public function show(FlatServiceOrder $flatServiceOrder)
    {
        return view('order.show', ['orders' => $flatServiceOrder]);
    }
}
