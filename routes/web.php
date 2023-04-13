<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/kategori/{slug_categoryname}',[\App\Http\Controllers\CategoriesController::class,'index'])->name('category.index');
Route::get('/urun/{slug_productname}',[\App\Http\Controllers\ProductsController::class,'index'])->name('product.index');
Route::post('/ara',[\App\Http\Controllers\ProductsController::class,'Search'])->name('product.search');
Route::get('/ara',[\App\Http\Controllers\ProductsController::class,'Search'])->name('product.search');
Route::get('/sepet',[\App\Http\Controllers\BasketController::class,'index'])->name('basket.index')->middleware('auth');
Route::group(['middleware' =>'auth'],function (){
    Route::get('/odeme',[\App\Http\Controllers\PayController::class,'index'])->name('pay.index');
    Route::get('/siparisler',[\App\Http\Controllers\OrdersController::class,'index'])->name('order.index');
    Route::get('/siparisler/{id}',[\App\Http\Controllers\OrdersController::class,'details'])->name('order.details');
});
Route::prefix('kullanici')->name('users.')->group(function () {
    Route::get('/girisyay',[\App\Http\Controllers\UsersController::class,'login'])->name('login');
    Route::get('/kayitol',[\App\Http\Controllers\UsersController::class,'register'])->name('register');
    Route::post('/kayitol',[\App\Http\Controllers\UsersController::class,'registerpost'])->name('register.post');
    Route::get('/aktiflestir/{key}',[\App\Http\Controllers\UsersController::class,'activation'])->name('activate');
    Route::post('/girisyap',[\App\Http\Controllers\UsersController::class,'loginPost'])->name('loginpost');
    Route::post('/cikis',[\App\Http\Controllers\UsersController::class,'logOut'])->name('logout');
});


