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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/products')->group(function(){
    Route::get('/', 'App\Http\Controllers\Api\ProductController@index');
    Route::get('/{id}', 'App\Http\Controllers\Api\ProductController@show');
    Route::post('/', 'App\Http\Controllers\Api\ProductController@store');   
    Route::put('/{id}', 'App\Http\Controllers\Api\ProductController@update');
    Route::delete('/{id}', 'App\Http\Controllers\Api\ProductController@delete');

    });
