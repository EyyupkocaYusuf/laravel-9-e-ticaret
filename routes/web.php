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
Route::patch('sepet/update/{rowid}', [\App\Http\Controllers\BasketController::class, 'update'])
    ->name('basket.update')
    ->middleware('web');

// Admin Routes

Route::prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/admin/oturumac');
    Route::match(['get','post'],'/oturumac',[\App\Http\Controllers\Admin\AdminController::class,'login'])->name('login');
    Route::get('/cıkısyap',[\App\Http\Controllers\Admin\AdminController::class,'logout'])->name('logout');

    Route::group(['middleware' =>'Admin'],function (){
        Route::get('/anasayfa',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home');

        Route::prefix( 'kategori')->name('category.')->group(function (){
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('index');
            Route::get('/yeni', [\App\Http\Controllers\Admin\CategoryController::class,'form'])->name('add');
            Route::get('/duzenle/{id}', [\App\Http\Controllers\Admin\CategoryController::class,'form'])->name('edit');
            Route::post('/kaydet/{id?}', [\App\Http\Controllers\Admin\CategoryController::class,'save'])->name('save');
            Route::get('/sil/{id}', [\App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('delete');
        });

        Route::prefix( 'urun')->name('product.')->group(function (){
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\ProductController::class,'index'])->name('index');
            Route::get('/yeni', [\App\Http\Controllers\Admin\ProductController::class,'form'])->name('add');
            Route::get('/duzenle/{id}', [\App\Http\Controllers\Admin\ProductController::class,'form'])->name('edit');
            Route::post('/kaydet/{id?}', [\App\Http\Controllers\Admin\ProductController::class,'save'])->name('save');
            Route::get('/sil/{id}', [\App\Http\Controllers\Admin\ProductController::class,'delete'])->name('delete');
        });

        Route::prefix( 'siparis')->name('order.')->group(function (){
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\OrderController::class,'index'])->name('index');
            Route::get('/yeni', [\App\Http\Controllers\Admin\OrderController::class,'form'])->name('add');
            Route::get('/duzenle/{id}', [\App\Http\Controllers\Admin\OrderController::class,'form'])->name('edit');
            Route::post('/kaydet/{id?}', [\App\Http\Controllers\Admin\OrderController::class,'save'])->name('save');
            Route::get('/sil/{id}', [\App\Http\Controllers\Admin\OrderController::class,'delete'])->name('delete');
        });

        Route::prefix('kullanici')->name('user.')->group(function (){
            Route::match(['get','post'],'/',[\App\Http\Controllers\Admin\AdminController::class,'index']);
            Route::get('/yeni',[\App\Http\Controllers\Admin\AdminController::class,'form'])->name('new');
            Route::get('/düzenle/{id}',[\App\Http\Controllers\Admin\AdminController::class,'form'])->name('update');
            Route::post('/kaydet/{id?}',[\App\Http\Controllers\Admin\AdminController::class,'save'])->name('save');
            Route::get('/sil/{id}',[\App\Http\Controllers\Admin\AdminController::class,'delete'])->name('delete');
        });
    });
});

// Web Routes

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/kategori/{slug_categoryname}',[\App\Http\Controllers\CategoriesController::class,'index'])->name('category.index');

Route::get('/product/{slug_productname}',[\App\Http\Controllers\ProductsController::class,'index'])->name('product.index');

Route::post('/ara',[\App\Http\Controllers\ProductsController::class,'Search'])->name('product.search');
Route::get('/ara',[\App\Http\Controllers\ProductsController::class,'Search'])->name('product.search');

Route::prefix('sepet')->name('basket.')->group(function (){
    Route::get('/',[\App\Http\Controllers\BasketController::class,'index'])->name('index')->middleware('auth');
    Route::post('/ekle',[\App\Http\Controllers\BasketController::class,'add'])->name('add.product');
    Route::delete('/kaldır/{rowid}',[\App\Http\Controllers\BasketController::class,'remove'])->name('remove');
    Route::delete('/boşalt',[\App\Http\Controllers\BasketController::class,'unload'])->name('unload');
    Route::patch('/update/{rowid}',[\App\Http\Controllers\BasketController::class,'update'])->name('update');
});

Route::get('/odeme',[\App\Http\Controllers\PayController::class,'index'])->name('pay.index');
Route::post('/odeme',[\App\Http\Controllers\PayController::class,'topay'])->name('pay.topay');

Route::group(['middleware' =>'auth'],function (){
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
