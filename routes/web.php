<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Middleware\PreventBackHistory;


Route::get('/', function () {
    if(Auth::guard('web')->check()){return redirect()->route('main');}
    else{return view('Application.Auth.Login');}
})->name('login')->middleware(PreventBackHistory::class);


Route::middleware(['auth:web'])->group( function() {
    Route::get('/main', function() {
        return view('Application.Layouts.MainPage');
    })->name('main')->middleware(PreventBackHistory::class);
});


//Admin Controller 
Route::post('/login', [AdminController::class , 'LoginAdmin'])->name('admin.login');
Route::post('/logout',[AdminController::class , 'LogoutAdmin'])->name('admin.logout');



//Products Controller
Route::post('/create', [ProductController::class, 'CreateProduct'])->name('product.create');
Route::get('/products', [ProductController::class, 'GetAllProducts'])->name('product.get');
Route::put('/EditProduct/{id}', [ProductController::class, 'GetProductById'])->name('product.get.single');
Route::delete('/DeleteProduct/{id}', [ProductController::class, 'DeleteProduct'])->name('product.delete');