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
	Route::get('accounts/ng-account-list',"AccountsController@accountList");
	Route::resource('accounts',"AccountsController");
	
	Route::get('checkbooks/ng-checkbook-list',"CheckBooksController@checkbookList");
	Route::resource('checkbooks',"CheckBooksController");

	Route::get('check-issuances/payee/{check_id}',"CheckIssuancesController@getPayee");
	Route::resource('check-issuances',"CheckIssuancesController");
	Route::resource('check-warehouses',"CheckWarehousesController");

	Route::get('check-reset/cancel',"CheckCancelController@cancel");
	Route::resource('check-reset',"CheckCancelController");
	Route::resource('check-settles',"CheckSettlesController");

	Route::get('payees/ng-payee-list',"PayeesController@payeeList");
	Route::resource('payees',"PayeesController");
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
