<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')
    ->name('api.')
    ->group(function() {

        Route::resource('product-categories', ProductCategoryController::class)->except(['create', 'edit']);
        Route::get('product-categories/{id}/products', [ProductController::class, 'index']);

        Route::resource('products', ProductController::class)->except(['index', 'create', 'edit']);

    });

Route::middleware('api')
    ->name('api.')
    ->group(function() {

        Route::name('auth.')
            ->prefix('auth')
            ->group(function() {
                Route::post('register', [RegisterController::class, 'store']);
                Route::post('login', [LoginController::class, 'show']);
            });

    });