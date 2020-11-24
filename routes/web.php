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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','IndexController@index');

Route::match(['get','post'],'/contact-us','ContactController@contact');

Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//All items menu page
Route::get('/items/{url}','ItemsController@items');

//Item detail page
Route::get('/item/{id}','ItemsController@item');

//Get Item prices
Route::any('/get-item-price','ItemsController@getItemPrice');

//Basket page
Route::match(['get','post'],'/basket','ItemsController@basket');

//Add to basket
Route::match(['get','post'],'/add-basket','ItemsController@addToBasket');

//Delete basket item
Route::get('/basket/delete-item/{id}','ItemsController@deleteBasketItem');

//update item quantity in basket
Route::get('/basket/update-quantity/{id}/{quantity}','ItemsController@updateBasketQuantity');

//Users login/register page
Route::get('/login-register','UsersController@userLoginRegister');

//Users Register form submit
Route::post('/user-register', 'UsersController@register');

//user login
Route::post('/user-login','UsersController@login');

//user logout
Route::get('/user-logout','UsersController@logout');


//Routes after login
Route::group(['middleware' => ['frontLogin']],function(){
    //Account Page
    Route::match(['get','post'], '/account','UsersController@account');
    //check Users current password
    Route::post('/check-user-pwd','UsersController@chkUserPassword');
    //update password
    Route::post('/update-user-pwd','UsersController@updatePassword');
    //checkout page
    Route::match(['get','post'],'/checkout','ItemsController@checkout');
    //Order Review page
    Route::match(['get','post'],'/order-review','ItemsController@orderReview');
    //Place order page
    Route::match(['get','post'],'/place-order','ItemsController@placeOrder');
    //Order complete page
    Route::get('/thanks','ItemsController@thanks');
    //Paypal page
    Route::get('/paypal','ItemsController@paypal');
    //Paypal thanks page
    Route::get('/paypal/thanks','ItemsController@thanksPaypal');
    //Orders Page
    Route::get('/orders','ItemsController@userOrders');
    //Orders Page
    Route::get('/orders/{id}','ItemsController@userOrderDetails');
});


//Check if user already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['auth']],function(){
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

    //Routes for catergories (admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');

    //Routes for items (admin)
    Route::match(['get','post'],'/admin/add-item','ItemsController@addItem');
    Route::match(['get','post'],'/admin/edit-item/{id}','ItemsController@editItem');
    Route::get('/admin/view-items','ItemsController@viewItems');
    Route::get('/admin/delete-item/{id}','ItemsController@deleteItem');
    Route::get('/admin/delete-item-image/{id}','ItemsController@deleteItemImage');

    //Routes for item attributes
    Route::match(['get','post'],'/admin/add-attribute/{id}','ItemsController@addAttributes');
    Route::get('/admin/delete-attribute/{id}','ItemsController@deleteAttribute');

    //Admin Orders Routes
    Route::get('/admin/view-orders','ItemsController@viewOrders');
    Route::get('/admin/view-order/{id}','ItemsController@viewOrderDetails');
    Route::post('/admin/update-order-status','ItemsController@updateOrderStatus');

});



Route::get('/logout', 'AdminController@logout');

