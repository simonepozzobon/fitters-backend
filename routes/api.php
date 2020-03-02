<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'LoginController@login')->name('login');
Route::post('register', 'LoginController@register')->name('register');

Route::middleware('auth:api')->group(
    function () {
        Route::get('user', 'LoginController@getUser');

        Route::prefix('profile')->group(
            function () {
                Route::prefix('subscriptions')->group(
                    function () {
                        Route::post('create', 'SubscriptionController@create');
                    }
                );
            }
        );
    }
);


Route::get('test-request', 'TestController@test');

Route::post('newsletter', 'NewsletterController@addSubscriber');
Route::post('send-mail', 'MailController@sendMail');
