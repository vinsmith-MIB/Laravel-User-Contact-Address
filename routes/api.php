<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/users', [\App\Http\Controllers\UserControllerApi::class, 'register']);
Route::post('/users/login', [\App\Http\Controllers\UserControllerApi::class, 'login']);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [\App\Http\Controllers\UserControllerApi::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\UserControllerApi::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\UserControllerApi::class, 'logout']);

    Route::post('/contacts', [\App\Http\Controllers\ContactControllerApi::class, 'create']);
    Route::get('/contacts', [\App\Http\Controllers\ContactControllerApi::class, 'search']);
    Route::get('/contacts/{id}', [\App\Http\Controllers\ContactControllerApi::class, 'get'])->where('id', '[0-9]+');
    Route::put('/contacts/{id}', [\App\Http\Controllers\ContactControllerApi::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/contacts/{id}', [\App\Http\Controllers\ContactControllerApi::class, 'delete'])->where('id', '[0-9]+');

    Route::post('/contacts/{idContact}/addresses', [\App\Http\Controllers\AddressControllerApi::class, 'create'])
        ->where('idContact', '[0-9]+');
    Route::get('/contacts/{idContact}/addresses', [\App\Http\Controllers\AddressControllerApi::class, 'list'])
        ->where('idContact', '[0-9]+');
    Route::get('/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressControllerApi::class, 'get'])
        ->where('idContact', '[0-9]+')
        ->where('idAddress', '[0-9]+');
    Route::put('/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressControllerApi::class, 'update'])
        ->where('idContact', '[0-9]+')
        ->where('idAddress', '[0-9]+');
    Route::delete('/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressControllerApi::class, 'delete'])
        ->where('idContact', '[0-9]+')
        ->where('idAddress', '[0-9]+');
});
