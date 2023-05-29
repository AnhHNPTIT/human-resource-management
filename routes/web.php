<?php

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
// trang chu --> update
Route::get('/', function () {
	return view('home');
});

// login --> update
Route::get('/login', function () {
	return view('login');
});

// dang nhap --> update
Route::post('/login', 'Customer\LoginController@postLogin');

// dang xuat --> update
Route::get('/logout', 'Customer\LogoutController@logout');

// dang ky
Route::get('/register', function () {
	return view('register');
});
Route::post('/register', 'Customer\RegisterController@register');
// cap nhat thong tin
Route::get('/fulfill/information', 'Customer\RegisterController@fulfill');
// tao tai khoan
Route::post('/create/account', 'Customer\RegisterController@createAccount');

// tim kiem san pham --> update
Route::get('/search', 'Customer\SearchController@search');

// cua hang --> update
Route::get('/cua-hang/bo-sung-vitamin-khoang-chat', 'Customer\VitaminProductController@vitaminProduct');
Route::get('/cua-hang/nuoc-tang-luc-giai-khat', 'Customer\EnergyProductController@energyProduct');
Route::get('/cua-hang/giau-chat-xo-tieu-hoa', 'Customer\FiberProductController@fiberProduct');
Route::get('/cua-hang/chuc-nang-dac-biet', 'Customer\SpecialProductController@specialProduct');

// chi tiet san pham --> update
Route::get('/san-pham/{slug}', 'Customer\HomeController@productDetail');

// tat ca bai viet --> update
Route::get('/ban-tin-suc-khoe', 'Customer\HomeController@index');

// bai viet theo tag --> update
Route::get('/tag/{slug}', 'Customer\HomeController@postTag');

// bai viet theo chuyen muc --> update
Route::get('/chuyen-muc/{slug}', 'Customer\HomeController@postTopic');

//chi tiet + noi dung bai viet  --> update
Route::get('/ban-tin-suc-khoe/{slug}', 'Customer\HomeController@postDetail');

// cart --> update
Route::post('/add/item', 'Customer\CartController@addSpecialItem');
Route::get('/checkout/cart', 'Customer\CartController@index');
Route::post('/checkout/cart', 'Customer\CartController@addItem');
Route::delete('/remove-cart/{id}', 'Customer\CartController@remove');
Route::get('/clear/cart', 'Customer\CartController@clearCart');
// increment --> update
Route::post('/increment/cart', 'Customer\CartController@increment');
// decrement --> update
Route::post('/decrement/cart', 'Customer\CartController@decrement');
Route::get('/checkout/cart/item/number', 'Customer\CartController@getItemNumber');

// checkout payment --> update
Route::get('/checkout/payment', 'Customer\CheckoutController@index');
Route::post('/checkout/payment', 'Customer\CheckoutController@order');

// order-received
Route::get('/checkout/order-received/{order_id}', 'Customer\CheckoutController@orderReceived');

Route::group(['prefix' => '/', 'middleware' => 'CheckUserLogin'], function () {
	// my account --> update 
	Route::get('/my_account/{customer_id}', 'Customer\AccountController@myAccount');
	// update account information --> update
	Route::post('/my_account', 'Customer\AccountController@updateMyAccount');

	// change password --> update
	Route::get('/change/password', 'Customer\ChangePasswordController@getFormChangePassword');
	Route::post('/change/password', 'Customer\ChangePasswordController@changePassword');

	// wishlist --> update
	Route::get('/wishlist', 'Customer\WishlistController@index');
	Route::delete('/remove-wishlist/{product_id}', 'Customer\WishlistController@delete');

	// my transactions --> update
	Route::get('/transaction/history/{customer_id}', 'Customer\TransactionHistoryController@myTransaction');
	// order detail --> update
	Route::get('/transaction/detail/{order_id}', 'Customer\TransactionHistoryController@myOrder');
});

// add item on wishlist --> update
Route::post('/wishlist', 'Customer\WishlistController@addWishlist');

// link --> update
Route::get('/gioi-thieu', function () {
	return view('introduction');
});
Route::get('/phuong-thuc-van-chuyen', function () {
	return view('shipment');
});
Route::get('/quy-dinh-su-dung', function () {
	return view('policy');
});

Route::get('/lien-he', 'Customer\NavigatorController@getFormContact');
Route::post('/lien-he', 'Customer\NavigatorController@postFormContact');

// admin
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdminLogin'], function () {
	// customer member --> update
	Route::get('/user/customer', 'UserController@customer');
	Route::put('/user/customer/{id}', 'UserController@updateCustomer');
	Route::delete('/user/customer/{id}', 'UserController@destroyCustomer');
	Route::get('/user/customer/{id}', 'UserController@show');

	// collaborator member --> update
	Route::get('/user/collaborator', 'UserController@collaborator');
	Route::post('/user/collaborator', 'UserController@store');
	Route::put('/user/collaborator/{id}', 'UserController@updateCollaborator');
	Route::get('/user/collaborator/{id}', 'UserController@showCollaborator');
	Route::post('/user/collaborator/update', 'UserController@updateInformationCollaborator');
	Route::delete('/user/collaborator/{id}', 'UserController@destroyCollaborator');
	Route::get('/new/collaborator', function () {
		return view('user.new_collaborator');
	});

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

// admin-collaborator
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function () {

	// get home page admin --> update
	Route::get('/', 'AdminController@homePage');
	Route::get('/home', 'AdminController@homePage');

	// get change pass --> update
	Route::get('/change/password', 'Auth_Admin\LoginController@getChangePassword');
	Route::post('/change/password', 'Auth_Admin\LoginController@changePassword');

	// post category --> update
	Route::resource('post-category', 'PostCategoryController');
	Route::post('/update-post-category', 'PostCategoryController@edit');
	Route::get('/new/post-category', function () {
		return view('post_category.new_post_category');
	});

	// posts --> update
	Route::resource('post', 'PostController');
	Route::get('post/detail/{id}', 'PostController@showPost');
	Route::post('post/update', 'PostController@updatePost');
	Route::get('/new/post', function () {
		return view('post.new_post');
	});

	// tags --> update
	Route::resource('tag', 'TagController');
	Route::get('/new/tag', function () {
		return view('tag.new_tag');
	});

	// manufacturers --> update
	Route::get('/manufacturer', 'ManufactureController@index');
	Route::get('/manufacturer/{id}', 'ManufactureController@show');
	Route::put('/manufacturer/{id}', 'ManufactureController@update');
	Route::post('/manufacturer', 'ManufactureController@store');
	Route::get('/new/manufacturer', function () {
		return view('manufacturer.new_manufacturer');
	});
	Route::delete('/manufacturer/{id}', 'ManufactureController@destroy');

	// units --> update
	Route::get('/unit', 'UnitController@index');
	Route::get('/unit/{id}', 'UnitController@show');
	Route::put('/unit/{id}', 'UnitController@update');
	Route::post('/unit', 'UnitController@store');
	Route::get('/new/unit', function () {
		return view('unit.new_unit');
	});
	Route::delete('/unit/{id}', 'UnitController@destroy');

	// products --> update
	Route::get('/product', 'ProductController@index');
	Route::get('/product/detail/{id}', 'ProductController@show');
	Route::post('/product/update', 'ProductController@update');
	Route::post('/product', 'ProductController@store');
	Route::get('/new/product', function () {
		return view('product.new_product');
	});
	Route::delete('/product/{id}', 'ProductController@destroy');
	Route::put('/update-status-product/{id}', 'ProductController@updateStatus');

	// transactions
	Route::get('/transaction', 'TransactionController@index');
	Route::get('/transaction_pending', 'TransactionController@pending');
	Route::get('/transaction_shipped', 'TransactionController@shipped');
	Route::get('/transaction_delivered', 'TransactionController@delivered');
	Route::get('/transaction_cancel', 'TransactionController@cancel');
	Route::get('/transaction/{order_id}', 'TransactionController@show');
	Route::get('/transaction_note/{id}', 'TransactionController@note');
	Route::put('/transaction/{id}', 'TransactionController@update');
	Route::put('/transaction/cancel/{id}', 'TransactionController@cancelTransaction');
	Route::delete('/transaction/{id}', 'TransactionController@destroy');
});

// admin
Route::group(['prefix' => 'admin'], function () {
	// authentication routes... --> update
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth_Admin\LoginController@postLoginAdmin');
	Route::get('/logout', 'Auth_Admin\LoginController@logoutAdmin')->name('logout');
});
