<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
//});
