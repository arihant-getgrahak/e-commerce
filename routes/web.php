<?php


use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('category', function () {
    return view('addcategroy');
});

Route::get('product/add', function () {
    return view('addproduct');
});

Route::get('product/view', [ProductController::class, "display"]);


Route::post("category/add", [ParentCategoryController::class, "store"])->name("category.add");
Route::post("product/add", [ProductController::class, "store"])->name("product.add");
