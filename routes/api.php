<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'UserController@login');
Route::get('/product', 'ProductController@all');
Route::post('/order', 'OrderController@store');

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.verify']], function() {
    Route::get('/product', 'ProductController@all');
    Route::post('/product', 'ProductController@store');
    Route::get('/product/{id}', 'ProductController@get');
    Route::put('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@delete');

    Route::get('/order', 'OrderController@all');
    Route::get('/order/{id}', 'OrderController@get');
    Route::delete('/order/{id}', 'OrderController@delete');

    Route::get('/user', 'UserController@all');
    Route::get('/user/{id}', 'UserController@get');
    Route::get('/logout', 'UserController@logout');
});
