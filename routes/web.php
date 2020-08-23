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


Route::get('/', 'StaticController@index')->name('index');
Route::get('/about', 'StaticController@about')->name('about');
Route::get('/rules', 'StaticController@rules')->name('rules');
Route::get('/search', 'FlatController@search')->name('flat-search');
Route::get('/apartment/{id}', 'FlatController@index')->name('flat-page');



Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

