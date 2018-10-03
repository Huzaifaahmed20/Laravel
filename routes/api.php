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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('users', 'API\UserController@getusers');
Route::group(['middleware' => 'auth:api'], function(){
Route::get('details', 'API\UserController@details');
});



Route::post('create/ticket','TicketController@store');
Route::get('show/tickets','TicketController@show');
Route::put('update/ticket/{id}','TicketController@update');
Route::delete('delete/ticket/{id}','TicketController@delete');
// Route::get('tickets', 'TicketController@index');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
