<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(["middleware" => AdminMiddleware::class], function () {

    Route::get('admin', function () {
        return view('admin');
    })->name("admin");

    Route::group(["prefix" => "/product"], function () {
        Route::get('category', function () {
            return view('addcategroy');
        })->name('category');

        Route::get('add', [ProductController::class, 'index'])->name('product.add');

        Route::get('view', [ProductController::class, "admindisplay"])->name('product.view');
    });
});

Route::get("/child-category/{id}", [ProductController::class, "child_category"])->name("child-category");

Route::get("login", function () {
    return view("login");
})->name("login");

Route::get("logout", [AuthController::class, "logout"])->name("logout");


Route::post("category/add", [CategoryController::class, "store"])->name("category.add");
Route::post("product/add", [ProductController::class, "store"])->name("product.add");
Route::post("login", [AuthController::class, "login"])->name("login");

Route::get("/", [ProductController::class, "display"])->name("product");
Route::get("product/{id}", [ProductController::class, "specific"])->name("product.specific");
