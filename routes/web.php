<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', function () {
    return view('counter');
});

// Livewire Todo Application Routes
Route::get('todo', function(){
    return view('todo'); 
});

Route::group(['prefix'  =>   'payment'], function() {

    Route::get('/', 'App\Http\Controllers\PaymentController@index')->name('payment');
    Route::get('/send', 'App\Http\Controllers\PaymentController@pay')->name('payment.send');
    Route::post('/send', 'App\Http\Controllers\PaymentController@pay_two')->name('payment.send');
    Route::get('/success', 'App\Http\Controllers\PaymentController@success');
    Route::post('/cancel', 'App\Http\Controllers\PaymentController@cancel');
    Route::get('/failed', 'App\Http\Controllers\PaymentController@failed');

});

