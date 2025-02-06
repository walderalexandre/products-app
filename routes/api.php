<?php
use App\Http\Controllers\ProductController;

// Rotas dos produtos
Route::prefix('products')->group(function () {
    // Listar todos os produtos
    Route::get('/', [ProductController::class, 'index']);

    // Obter um produto específico
    Route::get('/{id}', [ProductController::class, 'show']);

    // Criar um novo produto
    Route::post('/', [ProductController::class, 'store']);

    // Atualizar um produto existente
    Route::put('/{id}', [ProductController::class, 'update']);

    // Excluir um produto
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
