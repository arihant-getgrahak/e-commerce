<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('product/category', function () {
    return view('addcategroy');
});

Route::get('product/add', function () {
    return view('addproduct');
});

Route::get('product/view', [ProductController::class, "display"]);

Route::get("login", function () {
    return view("login");
});


Route::post("category/add", [ParentCategoryController::class, "store"])->name("category.add");
Route::post("product/add", [ProductController::class, "store"])->name("product.add");
Route::post("login", [AuthController::class, "login"])->name("login");
