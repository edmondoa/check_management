<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'web'], function () {
	Route::get('logout','Auth\LoginController@logout');
	Auth::routes();
	Route::get('/', 'HomeController@index');

	Route::resource('accounts',"AccountsController");
	Route::resource('checkbooks',"CheckBooksController");
	Route::resource('check-issuances',"CheckIssuanceController");
	Route::resource('check-warehouses',"CheckWarehousesController");
	Route::resource('check-cancels',"CheckCancelsController");
	Route::resource('check-settles',"CheckSettlesController");
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
