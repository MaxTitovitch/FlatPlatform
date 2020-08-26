<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use Laravel\Socialite\Facades\Socialite;

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
    Route::get('/dialog', 'DialogController@index')->name('admin-dialog-list');
    Route::get('/dialog/{id}', 'DialogController@show')->name('admin-dialog-show');
    Route::post('/dialog/user/{id}', 'DialogController@create')->name('admin-dialog-create');
    Route::post('/send-message/{id}', 'DialogController@createMessage')->name('admin-send-message');
    Route::post('/remove-message/{id}', 'DialogController@removeMessage')->name('admin-remove-message');
});
Auth::routes(['verify' => true]);

// Static pages
Route::get('/', 'StaticController@index')->name('index');
Route::get('/about', 'StaticController@about')->name('about');
Route::get('/rules', 'StaticController@rules')->name('rules');

// Flat queries & pages
Route::get('/search', 'FlatController@search')->name('flat-search');
Route::get('/apartment/{id}', 'FlatController@index')->name('flat-page');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/add-flat-request/{id}', 'FlatController@addRequest')->name('flat-add-request');
    Route::patch('/reject-flat-request/{id}', 'FlatController@rejectRequest')->name('flat-reject-request');
    Route::patch('/accept-flat-request/{id}', 'FlatController@acceptRequest')->name('flat-accept-request');
    Route::patch('/confirm-flat-request/{id}', 'FlatController@confirmRequest')->name('flat-confirm-request');
    Route::patch('/complete-flat-request/{id}', 'FlatController@completeRequest')->name('flat-complete-request');
    Route::patch('/update-flat-price/{id}', 'FlatController@updateRequest')->name('flat-update-price');
});

// Dialog queries & pages
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dialog', 'DialogController@index')->name('dialog-list');
    Route::get('/dialog/{id}', 'DialogController@show')->name('dialog-show');
    Route::post('/dialog/user/{id}', 'DialogController@create')->name('dialog-create');
    Route::post('/send-message/{id}', 'DialogController@createMessage')->name('send-message');
    Route::post('/remove-message/{id}', 'DialogController@removeMessage')->name('remove-message');
});

// Personal
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::put('/home', 'HomeController@updateUser')->name('home-update');
    Route::resource('/home/flats', 'FlatCRUDController')->middleware('authorization:landlord');
    Route::resource('/home/services', 'HouseholdServiceCRUDController')->middleware('authorization:employee');
    Route::resource('/home/orders', 'FlatOrderCRUDController')->only(['index', 'show'])->middleware('authorization:tenant,landlord');
    Route::resource('/home/service-orders', 'HouseholdOrderCRUDController')->only(['index', 'show'])->middleware('authorization:landlord,employee');
});

//Route::get('/socialite/{provider}', ["as" => "socialite.auth", function ( $provider ) {
//            return Socialite::driver( $provider )->redirect();
//}]);
//
//Route::get('/socialite/{provider}/callback', function ($provider) {
//    $user = Socialite::driver($provider)->user();
//    dd($user);
//});
