<?php

namespace App\Http\Controllers;

use App\HouseholdService;
use Illuminate\Http\Request;

class HouseholdServiceController extends Controller
{
    public function index($id)
    {
        $householdService = HouseholdService::find($id);
        if ($householdService != null){
            return view('household-service.index', ['householdService'=>$householdService]);
        } else{
            return redirect()->route('index');
        }
    }

    public function search(Request $request)
    {
        $householdServices = HouseholdService::filtrateHouseholdService($request);
        return view('household-service.search', ['householdServices' => $householdServices]);
    }
}
