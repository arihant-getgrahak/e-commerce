<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(["middleware" => AdminMiddleware::class], function () {

    Route::get('admin', function () {
        return view('admin');
    })->name("admin");

    Route::group(["prefix" => "product"], function () {
        Route::get('category', function () {
            return view('addcategroy');
        });

        Route::get('add', function () {
            return view('addproduct');
        });

        Route::get('view', [ProductController::class, "display"]);
    });

});

Route::get("login", function () {
    return view("login");
})->name("login");

Route::get("logout", [AuthController::class, "logout"])->name("logout");


Route::post("category/add", [ParentCategoryController::class, "store"])->name("category.add");
Route::post("product/add", [ProductController::class, "store"])->name("product.add");
Route::post("login", [AuthController::class, "login"])->name("login");
