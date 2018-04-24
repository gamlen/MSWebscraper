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

Route::get('/changes', [
    'uses' => 'ChangeController@getContent'

]);

Route::post('/change', [
    'uses' => 'ChangeController@addContent'

]);

Route::post('/user', [
    'uses' => 'UserController@signup'
]);
