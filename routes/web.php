<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => AdminMiddleware::class], function () {

    Route::get('admin', function () {
        return view('admin');
    })->name('admin');

    Route::group(['prefix' => '/product'], function () {
        Route::get('category', [CategoryController::class, 'index'])->name('category');

        Route::get('add', [ProductController::class, 'index'])->name('product.add');

        Route::get('view', [ProductController::class, 'admindisplay'])->name('product.view');

        Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');

        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('brand', [BrandController::class, 'index'])->name('brand');
    });
});

Route::get('/child-category/{id}', [ProductController::class, 'child_category'])->name('child-category');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('register', function () {
    return view('register');
})->name('register');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('category/add', [CategoryController::class, 'store'])->name('category.add');
Route::post('category/child/add', [CategoryController::class, 'storechild'])->name('category.child.add');
Route::post('brand/add', [BrandController::class, 'store'])->name('brand.add');
Route::post('/product/add', [ProductController::class, 'store'])->name('product.add');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('/', [ProductController::class, 'display'])->name('product');
Route::get('product/{id}', [ProductController::class, 'specific'])->name('product.specific');

Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

Route::get('category/{id}', [CategoryController::class, 'filter'])->name('category.show');
Route::post('brand/filter', [BrandController::class, 'filter'])->name('brand.filter.show');
