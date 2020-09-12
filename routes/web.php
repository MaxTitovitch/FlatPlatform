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

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('error-log');
    Route::get('/dialog', 'DialogController@index')->name('admin-dialog-list');
    Route::get('/dialog/{id}', 'DialogController@show')->name('admin-dialog-show');
    Route::post('/dialog/user/{id}', 'DialogController@create')->name('admin-dialog-create');
    Route::post('/send-message/{id}', 'DialogController@createMessage')->name('admin-send-message');
    Route::post('/remove-message/{id}', 'DialogController@removeMessage')->name('admin-remove-message');
});

// Auth & Socialite routes
Auth::routes(['verify' => true]);
Route::get('/socialite/{provider}', "SocialiteController@index")->name('socialite.auth');
Route::get('/socialite/{provider}/callback', "SocialiteController@callback");
Route::post('/socialite/{provider}/save', "SocialiteController@save")->name('socialite.save');

// Static pages
Route::get('/', 'StaticController@index')->name('index');
Route::get('/about', 'StaticController@about')->name('about');
Route::post('/about', 'StaticController@aboutSave')->name('about-save');
Route::get('/rules', 'StaticController@rules')->name('rules');

// Flat pages & routes
Route::get('/search', 'FlatController@search')->name('flat-search');
Route::get('/apartment/{id}', 'FlatController@index')->name('flat-page');
Route::middleware(['auth', 'verified', 'passport'])->group(function () {
    Route::post('/add-flat-request/{id}', 'FlatController@addRequest')->name('flat-add-request');
    Route::patch('/reject-flat-request/{id}', 'FlatController@rejectRequest')->name('flat-reject-request');
    Route::patch('/accept-flat-request/{id}', 'FlatController@acceptRequest')->name('flat-accept-request');
    Route::patch('/confirm-flat-request/{id}', 'FlatController@confirmRequest')->name('flat-confirm-request');
    Route::patch('/complete-flat-request/{id}', 'FlatController@completeRequest')->name('flat-complete-request');
    Route::patch('/update-flat-price/{id}', 'FlatController@updateRequest')->name('flat-update-price');
});

// Household Service pages & routes
Route::get('/household-service/{id}', 'HouseholdServiceController@index')->name('household-service-page');
Route::get('/household-service-search', 'HouseholdServiceController@search')->name('household-service-search');
Route::middleware(['auth', 'verified', 'passport'])->group(function () {
    Route::post('/add-service-request/{id}', 'HouseholdServiceController@addRequest')->name('service-add-request');
    Route::patch('/reject-service-request/{id}', 'HouseholdServiceController@rejectRequest')->name('service-reject-request');
    Route::patch('/accept-service-request/{id}', 'HouseholdServiceController@acceptRequest')->name('service-accept-request');
    Route::patch('/confirm-service-request/{id}', 'HouseholdServiceController@confirmRequest')->name('service-confirm-request');
    Route::patch('/complete-service-request/{id}', 'HouseholdServiceController@completeRequest')->name('service-complete-request');
    Route::patch('/update-service-price/{id}', 'HouseholdServiceController@updateRequest')->name('service-update-price');
});


// Dialog and messages pages & routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dialog', 'DialogController@index')->name('dialog-list');
    Route::get('/dialog/{id}', 'DialogController@show')->name('dialog-show');
    Route::get('/dialog/user/{id}', 'DialogController@create')->name('dialog-create');
    Route::get('/dialog/flat/{id}', 'DialogController@createFlat')->name('dialog-flat-create');
    Route::get('/dialog/service/{id}', 'DialogController@createService')->name('dialog-service-create');
    Route::get('/dialog/support', 'DialogController@support')->name('dialog-support');
    Route::post('/send-message/{id}', 'DialogController@createMessage')->name('send-message');
    Route::post('/remove-message/{id}', 'DialogController@removeMessage')->name('remove-message');
});

// Personal area pages & routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::put('/home', 'HomeController@updateUser')->name('home-update');
    Route::middleware(['passport'])->group(function () {
        Route::resource('/home/flats', 'FlatCRUDController')->middleware('authorization:landlord');
        Route::resource('/home/services', 'HouseholdServiceCRUDController')->middleware('authorization:employee');
        Route::resource('/home/orders', 'FlatOrderCRUDController')->only(['index', 'show'])->middleware('authorization:tenant,landlord');
        Route::resource('/home/service-orders', 'HouseholdOrderCRUDController')->only(['index', 'show'])->middleware('authorization:landlord,employee');
    });
});

// Socialite
Route::get('/socialite/{provider}', "SocialiteController@index")->name('socialite.auth');
Route::get('/socialite/{provider}/callback', "SocialiteController@callback");
Route::post('/socialite/{provider}/save', "SocialiteController@save")->name('socialite.save');
