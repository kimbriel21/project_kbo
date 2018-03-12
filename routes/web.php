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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::any('/custom/login', function()
{
	return view('login');
});

Route::get('/home', 'HomeController@index')->name('home');

/*
Cryptocurrency
*/
Route::any('/wallet', 'CryptoCurrency\Wallet@wallet');
Route::any('/send_coin', 'CryptoCurrency\Wallet@send_coin_request');
Route::any('/get_transaction_list/{user_key}', 'CryptoCurrency\Wallet@get_transaction_list');
Route::any('/get_wallet_balance/{user_key}', 'CryptoCurrency\Wallet@get_wallet_balance');

/*
Chat System
*/
// Route::any('/chat', function()
// {
// 	return view('chat.chat_view');
// });

Route::any('/chat', 'ChatSystem\ChatController@chat');
Route::any('/send', 'ChatSystem\ChatController@send');



/*Angular JS*/

Route::any('/angularjs', 'AngularJS\AngularJSController@index');


/*JWT JSON WEB TOKEN*/
Route::get('/token/auth', 'Auth\TokenController@authenticate');
Route::get('/token/get_token', 'Auth\TokenController@get_token');


Route::any('/layoutpractice', function()
{
	return view('practice_layout');
});

Route::any('/test', 'Auth\TokenController@test');