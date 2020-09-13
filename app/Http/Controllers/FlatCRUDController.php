<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FlatCRUDRequest;

class FlatCRUDController extends Controller
{
    public function index()
    {
        $flats = Auth::user()->flats;
        return view('flat-crud.index', ['flats' => $flats]);
    }

    public function create()
    {
        return view('flat-crud.create');
    }


    public function store(FlatCRUDRequest $request)
    {
        $flat = Flat::create($request->all());
        $flat->user_id = Auth::id();
        $flat->uploadImages($request);
        $flat->save();
        Session::flash('status-success', 'Объявление создано!');
        return redirect()->route('flats.edit', ['flat' => $flat->id]);
    }


    public function show(Flat $flat)
    {
        return redirect()->route('flat-page', ['id' =>  $flat->id]);
    }


    public function edit(Flat $flat)
    {
        return view('flat-crud.create', ['flat' => $flat]);
    }


    public function update(FlatCRUDRequest $request, Flat $flat)
    {
        $flat->update($request->all());
        $flat->updateImages($request);
        $flat->user_id = Auth::id();
        $flat->save();
        Session::flash('status-success', 'Объявление изменено!');
        return redirect()->route('flats.edit', ['flat' =>  $flat->id]);
    }


    public function destroy(Flat $flat)
    {
        $flat->deleteImages();
        $flat->delete();
        Session::flash('status-success', 'Объявление удалено!');
        return redirect()->route('flats.index');
    }
}
