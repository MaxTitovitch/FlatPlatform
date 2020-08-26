<?php

namespace App\Http\Controllers;

use App\FlatServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatOrderCRUDController extends Controller
{
    public function index()
    {
        return view('order.index', ['orders' => Auth::user()->flat_orders]);
    }

    public function show(FlatServiceOrder $flatServiceOrder)
    {
        return view('order.show', ['orders' => $flatServiceOrder]);
    }
}
