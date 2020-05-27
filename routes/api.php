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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::middleware('auth:api')->group( function () {
    Route::get('queues', 'API\QueueController@index');
    Route::post('queue', 'API\QueueController@store');
    Route::put('queue/{id}', 'API\QueueController@update');
    Route::delete('queue/{id}', 'API\QueueController@destroy');
    Route::post('nextQueue/{clinic_no}', 'API\QueueController@nextQueue');
    
});

Route::get('queue/{id}', 'API\QueueController@show');
