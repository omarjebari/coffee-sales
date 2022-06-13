<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShippingCostController;
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
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// @TODO: This would normally go under the sanctum middleware but its using cookies!

Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::post('store', [SaleController::class, 'store'])->name('sales.store');
});
Route::prefix('shipping-costs')->group(function () {
    Route::get('/', [ShippingCostController::class, 'index'])->name('shipping-costs.index');
    Route::post('store', [ShippingCostController::class, 'store'])->name('shipping-costs.store');
});
