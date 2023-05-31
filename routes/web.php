<?php
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdminLogin'], function () {
	// account
	Route::get('/account', 'UserController@account');
	Route::post('/account', 'UserController@store');
	Route::post('/account/{id}', 'UserController@update');
	Route::get('/account/{id}', 'UserController@show');
	Route::get('/new/account', 'UserController@create');
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

	// file
	Route::get('/file', 'FileController@filesIndex');
	Route::post('/file', 'FileController@store');
	Route::post('/file/{id}', 'FileController@update');
	Route::get('/file/{id}', 'FileController@show');
	Route::get('/new/file', 'FileController@create');
	Route::delete('/file/{id}', 'FileController@destroy');

	// work
	Route::get('/work', 'WorkController@worksIndex');
	Route::post('/work', 'WorkController@store');
	Route::post('/work/{id}', 'WorkController@update');
	Route::get('/work/{id}', 'WorkController@show');
	Route::get('/new/work', 'WorkController@create');
	Route::delete('/work/{id}', 'WorkController@destroy');


	// salary detail
	Route::get('/salary/detail', 'SalaryDetailController@indexSalaryDetail');
	Route::post('/salary/detail', 'SalaryDetailController@store');
	Route::post('/salary/detail/{id}', 'SalaryDetailController@update');
	Route::get('/salary/detail/{id}', 'SalaryDetailController@show');
	Route::get('/new/salary/detail', 'SalaryDetailController@create');
	Route::delete('/salary/detail/{id}', 'SalaryDetailController@destroy');

	// report chart
	Route::get('/chart', 'AdminController@index');
	Route::get('/home', 'AdminController@index');
	Route::get('/report-account-department', 'ReportController@reportAccount');
	Route::get('/report-salary-department', function () {
		return view('admin.report_salary');
	});
	Route::get('/report-salary', 'ReportController@reportSalary');
});

// admin
Route::group(['prefix' => 'admin'], function () {
	// authentication routes... --> update
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth_Admin\LoginController@postLoginAdmin');
	Route::get('/logout', 'Auth_Admin\LoginController@logoutAdmin')->name('logout');
});
