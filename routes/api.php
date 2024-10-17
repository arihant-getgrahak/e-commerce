<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::group(["prefix" => "product"], function () {
    Route::get("/", [ProductController::class, "display"]);
    Route::get("/{id}", [ProductController::class,"specific"]);
    Route::post("/store", [ProductController::class, "store"]);
    Route::post("/update/{id}", [ProductController::class, "update"]);
    Route::delete("/delete/{id}", [ProductController::class, "delete"]);
});