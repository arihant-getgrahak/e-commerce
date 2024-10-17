<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ChildCategoryController;


Route::group(["prefix" => "product"], function () {
    Route::get("/", [ProductController::class, "display"]);
    Route::get("/{id}", [ProductController::class, "specific"]);
    Route::post("/store", [ProductController::class, "store"]);
    Route::post("/update/{id}", [ProductController::class, "update"]);
    Route::delete("/delete/{id}", [ProductController::class, "delete"]);
});

Route::group(["prefix" => "category"], function () {
    Route::get("/", [ParentCategoryController::class, "display"]);
    Route::post("/store", [ParentCategoryController::class, "store"]);
    Route::post("/update/{id}", [ParentCategoryController::class, "update"]);
    Route::delete("/delete/{id}", [ParentCategoryController::class, "delete"]);
});

Route::group(["prefix" => "category/child"], function () {
    Route::get("/", [ChildCategoryController::class, "display"]);
    Route::post("/store", [ChildCategoryController::class, "store"]);
    Route::post("/update/{id}", [ChildCategoryController::class, "update"]);
    Route::delete("/delete/{id}", [ChildCategoryController::class, "delete"]);
});