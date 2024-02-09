<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ \App\Http\Controllers\ProductsController::class,'index'])->name('index');

Route::prefix('cart')->group(function (){
    Route::get('/', [\App\Http\Controllers\CartsController::class,'index'])->name('carts')->middleware('auth');
    Route::post('add', [\App\Http\Controllers\CartsController::class,'add'])->name('carts.add')->middleware('auth');
    Route::post('update', [\App\Http\Controllers\CartsController::class,'update'])->name('carts.update')->middleware('auth');
    Route::post('delete', [\App\Http\Controllers\CartsController::class,'delete'])->name('carts.delete')->middleware('auth');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
