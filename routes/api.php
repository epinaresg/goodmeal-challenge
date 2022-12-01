<?php

use App\Http\Controllers\Api\Backoffice\Category\CreateCategoryController;
use App\Http\Controllers\Api\Backoffice\Category\DeleteCategoryController;
use App\Http\Controllers\Api\Backoffice\Category\ListCategoriesController;
use App\Http\Controllers\Api\Backoffice\Category\ShowCategoryController;
use App\Http\Controllers\Api\Backoffice\Category\UpdateCategoryController;
use App\Http\Controllers\Api\Backoffice\Product\CreateProductController;
use App\Http\Controllers\Api\Backoffice\Product\DeleteProductController;
use App\Http\Controllers\Api\Backoffice\Product\ListProductsController;
use App\Http\Controllers\Api\Backoffice\Product\ShowProductController;
use App\Http\Controllers\Api\Backoffice\Product\UpdateProductController;
use App\Http\Controllers\Api\Backoffice\Store\CreateStoreController;
use App\Http\Controllers\Api\Backoffice\Store\DeleteStoreController;
use App\Http\Controllers\Api\Backoffice\Store\ListStoresController;
use App\Http\Controllers\Api\Backoffice\Store\ShowStoreController;
use App\Http\Controllers\Api\Backoffice\Store\UpdateStoreController;
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
    Route::get('/back-office/stores/{store}', ShowStoreController::class);
    Route::post('/back-office/stores', CreateStoreController::class);
    Route::put('/back-office/stores/{store}', UpdateStoreController::class);
    Route::delete('/back-office/stores/{store}', DeleteStoreController::class);


    Route::get('/back-office/stores/{store}/categories', ListCategoriesController::class);
    Route::get('/back-office/stores/{store}/categories/{category}', ShowCategoryController::class);
    Route::post('/back-office/stores/{store}/categories', CreateCategoryController::class);
    Route::put('/back-office/stores/{store}/categories/{category}', UpdateCategoryController::class);
    Route::delete('/back-office/stores/{store}/categories/{category}', DeleteCategoryController::class);


    Route::get('/back-office/stores/{store}/products', ListProductsController::class);
    Route::get('/back-office/stores/{store}/products/{product}', ShowProductController::class);
    Route::post('/back-office/stores/{store}/products', CreateProductController::class);
    Route::put('/back-office/stores/{store}/products/{product}', UpdateProductController::class);
    Route::delete('/back-office/stores/{store}/products/{product}', DeleteProductController::class);
});
