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

	Route::post('check-reset/cancel',"CheckCancelController@setCancel");
	Route::resource('check-reset',"CheckCancelController");

	Route::get('check-settle/cancel','CheckSettleController@cancel');
	Route::get('check-settle/setCommit','CheckSettleController@setCommit');
	Route::get('check-settle/getSettle','CheckSettleController@getSettle');
	Route::post('check-settle/findCheck','CheckSettleController@findCheck');
	Route::resource('check-settle',"CheckSettleController");

	Route::get('payees/ng-payee-list',"PayeesController@payeeList");
	Route::resource('payees',"PayeesController");
	Route::resource('reports',"ReportsController");

	Route::get('logs',"LogsController@index");
	Route::get('logs/ng-list',"LogsController@logs");
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
