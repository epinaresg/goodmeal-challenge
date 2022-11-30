<?php

use App\Http\Controllers\Api\Backoffice\Store\CreateStoreController;
use App\Http\Controllers\Api\Backoffice\Store\DeleteStoreController;
use App\Http\Controllers\Api\Backoffice\Store\ListStoresController;
use App\Http\Controllers\Api\Backoffice\Store\UpdateStoreController;
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

Route::group(['middleware' => 'api'], function () {
    Route::get('/back-office/stores', ListStoresController::class);
    Route::post('/back-office/stores', CreateStoreController::class);
    Route::put('/back-office/stores/{store}', UpdateStoreController::class);
    Route::delete('/back-office/stores/{store}', DeleteStoreController::class);
});
