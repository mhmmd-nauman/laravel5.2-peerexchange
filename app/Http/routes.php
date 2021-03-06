<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'home.dashboard', 'uses' => 'HomeController@index']);
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'HomeController@getAdminDashboard']);

    Route::get('/settings', ['as' => 'settings', 'uses' => 'SettingsController@getIndex']);
    Route::post('/savesetttings', [ 'uses' => 'SettingsController@updateSetting']);
    
    Route::get('/bankaccount', ['as' => 'account.bankaccount', 'uses' => 'AccountController@getBankAccounts']);
    Route::post('/bankaccount', ['as' => 'account.bankaccount', 'uses' => 'AccountController@postBankAccount']);
     
    Route::get('/deposit', ['as' => 'account.deposit', 'uses' => 'AccountController@getDeposit']);
    Route::post('/deposit', ['as' => 'account.deposit', 'uses' => 'AccountController@postDeposit']);
    Route::get('/withdraw', ['as' => 'account.withdraw', 'uses' => 'AccountController@getWithdraw']);
    Route::post('/withdraw', ['as' => 'account.withdraw', 'uses' => 'AccountController@postWithdraw']);
    Route::get('/transactions', ['as' => 'account.transactions', 'uses' => 'AccountController@getTransactions']);

    Route::get('/buy', ['as' => 'market.buy', 'uses' => 'MarketController@getBuy']);
    Route::get('/make-buy/{id}', ['as' => 'market.makeBuy', 'uses' => 'MarketController@getMakeBuy']);
    Route::get('/make-hide/{id}', ['as' => 'market.makeHide', 'uses' => 'MarketController@getMakeBuy']);

    Route::get('/sell', ['as' => 'market.sell', 'uses' => 'MarketController@getSell']);
    Route::get('/sell-currency/{id}', ['as' => 'market.sell', 'uses' => 'MarketController@getSellCurrency']);
    Route::post('/sell', ['as' => 'market.sell', 'uses' => 'MarketController@postSell']);

    Route::get('/', function() {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return redirect('/login');
        }
    });
});
