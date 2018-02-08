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
