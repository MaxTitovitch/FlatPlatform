<?php

namespace App\Http\Controllers;

use App\HouseholdService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\HouseholdServiceCRUDRequest;

class HouseholdServiceCRUDController extends Controller
{
    public function index()
    {
        $services = Auth::user()->household_services;
        return view('service-crud.index', ['services' => $services]);
    }

    public function create()
    {
        return view('service-crud.create');
    }

    public function store(HouseholdServiceCRUDRequest $request)
    {
        $service = HouseholdService::create($request->all());
        $service->user_id = Auth::id();
        $service->save();
        Session::flash('status-success', 'Объявление создано!');
        return redirect()->route('household_service.edit', ['service' => $service->id]);
    }

    public function show(HouseholdService $householdService)
    {
        return redirect()->route('service-page', ['service' => $householdService]);
    }

    public function edit(HouseholdService $householdService)
    {
        return view('service-crud.create', ['service' => $householdService]);
    }

    public function update(HouseholdServiceCRUDRequest $request, HouseholdService $householdService)
    {
        $householdService->update($request->all());
        $householdService->user_id = Auth::id();
        $householdService->save();
        Session::flash('status-success', 'Объявление изменено!');
        return redirect()->route('household_service.edit', ['service' => $householdService->id]);
    }

    public function destroy(HouseholdService $householdService)
    {
        dump($householdService);
        $householdService->delete();
        Session::flash('status-success', 'Объявление удалено!');
        return redirect()->route('household_service.index');
    }
}
