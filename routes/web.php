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
    return view('anime');
});


Route::get('/form', function(){
	return view('form');
});


Route::get('/checkout', function(){
	return view('checkout');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/cart', 'HomeController@cart')->name('cart.index');
//Route::get('/checkout', 'HomeController@checkout')->name('checkout');
Route::post('/add', 'HomeController@add')->name('cart.store');
Route::post('/update', 'HomeController@update')->name('cart.update');
Route::post('/remove', 'HomeController@remove')->name('cart.remove');
Route::post('/clear', 'HomeController@clear')->name('cart.clear');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


Route::post( '/checkout', function (Request $request) {
	\Stripe\Stripe::setApiKey ( 'sk_test_51IYj13KlWyPG97llDGdoPfT1hxZXlk0LOlTMDfp4nJTRuic9t9QqJrHwqeyJKYYRdVCIxRNgzHNKSrHxPDnyX8XW00C44XGPUa' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => \Cart::getTotal() ,
				"currency" => "usd",
				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
				"description" => "Test payment." 
		) );
		Session::flash ( 'success-message', 'Payment done successfully !' );
		return Redirect::back ();
	} catch ( \Exception $e ) {
		Session::flash ( 'fail-message', "Error! Please Try again." );
		return Redirect::back ();
	}
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users') ->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);




});
