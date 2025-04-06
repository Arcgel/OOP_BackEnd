<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create', [ProductController::class, 'CreateProduct'])->name('product.create');
Route::get('/products', [ProductController::class, 'GetAllProducts'])->name('product.get');
Route::put('/EditProduct/{id}', [ProductController::class, 'GetProductById'])->name('product.get.single');
Route::delete('/ArchiveProduct/{id}', [ProductController::class, 'DeleteProduct'])->name('product.archive');
Route::delete('/RestoreProduct/{id}', [ProductController::class, 'RestoreProduct'])->name('product.archive');