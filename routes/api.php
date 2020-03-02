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

Route::middleware('auth:api')->group(
    function () {
        Route::get('user', 'LoginController@getUser');

        Route::prefix('profile')->group(
            function () {
                Route::prefix('subscription')->group(
                    function () {
                        Route::post('create', 'SubscriptionController@create');
                    }
                );
            }
        );
    }
);

Route::post('register', 'LoginController@register');
Route::post('login', 'LoginController@login');

Route::get('test-request', 'TestController@test');

Route::post('newsletter', 'NewsletterController@addSubscriber');
Route::post('send-mail', 'MailController@sendMail');
