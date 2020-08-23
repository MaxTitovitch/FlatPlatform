<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('error-log');
});
Auth::routes(['verify' => true]);

// Static pages
Route::get('/', 'StaticController@index')->name('index');
Route::get('/about', 'StaticController@about')->name('about');
Route::get('/rules', 'StaticController@rules')->name('rules');

// Flat pages
Route::get('/search', 'FlatController@search')->name('flat-search');
Route::get('/apartment/{id}', 'FlatController@index')->name('flat-page');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/add-flat-request/{id}', 'FlatController@addRequest')->name('flat-add-request');
    Route::patch('/reject-flat-request/{id}', 'FlatController@rejectRequest')->name('flat-reject-request');
    Route::patch('/accept-flat-request/{id}', 'FlatController@acceptRequest')->name('flat-accept-request');
});



Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

