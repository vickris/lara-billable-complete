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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/plans', 'PlansController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/plan/{plan}', 'PlansController@show');
    Route::get('/braintree/token', 'BraintreeTokenController@token');
    Route::post('/subscribe', 'SubscriptionController@create');

    Route::group(['middleware' => 'subscribed'], function () {
        Route::get('/lessons', 'LessonsController@index');
        Route::get('/subscriptions', 'SubscriptionController@index');
        Route::post('/subscription/cancel', 'SubscriptionController@cancel');
        Route::post('/subscription/resume', 'SubscriptionController@resume');
    });

    Route::group(['middleware' => 'premium-subscribed'], function () {
        Route::get('/prolessons', 'LessonsController@premium');
    });

});

Route::post(
    'braintree/webhooks',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);
