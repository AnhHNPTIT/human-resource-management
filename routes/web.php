<?php
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdminLogin'], function () {
	// account
	Route::get('/account', 'UserController@account');
	Route::post('/account', 'UserController@store');
	Route::post('/account/{id}', 'UserController@update');
	Route::get('/account/{id}', 'UserController@show');
	Route::get('/new/account', function () {
		return view('user.new_account');
	});
	Route::delete('/account/{id}', 'UserController@destroy');

	// contract
	Route::get('/contract', 'ContractController@contract');
	Route::post('/contract', 'ContractController@store');
	Route::post('/contract/{id}', 'ContractController@update');
	Route::get('/contract/{id}', 'ContractController@show');
	Route::get('/new/contract', function () {
		return view('contract.new_contract');
	});
	Route::delete('/contract/{id}', 'ContractController@destroy');

	// transaction
	Route::delete('/transaction/{id}', 'TransactionController@destroy');

	// report chart
	Route::get('/chart', 'AdminController@index');
	Route::get('/report_product', function () {
		return view('admin.report_product');
	});
	Route::get('/report_transaction', function () {
		return view('admin.report_transaction');
	});
	Route::post('/report_product/{id}', 'ProductController@reportProduct');
	Route::get('/report_product/{id}', 'ProductController@reportProduct');
	Route::post('/report_transaction/from_date={from_date}&to_date={to_date}&status={status}', 'TransactionController@reportTransaction');
	Route::get('/report_transaction/from_date={from_date}&to_date={to_date}&status={status}', 'TransactionController@reportTransaction');
});

// admin
Route::group(['prefix' => 'admin'], function () {
	// authentication routes... --> update
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth_Admin\LoginController@postLoginAdmin');
	Route::get('/logout', 'Auth_Admin\LoginController@logoutAdmin')->name('logout');
});