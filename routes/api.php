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
        Route::get('user', 'LoginController@get_user');
    }
);

Route::get('test-request', 'TestController@test');

Route::post('newsletter', 'NewsletterController@addSubscriber');
Route::post('send-mail', 'MailController@sendMail');

Route::post('login', 'LoginController@login');
