<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::group(["prefix" => "product"], function () {
    Route::get("/", [ProductController::class, "display"]);
    Route::post("/store", [ProductController::class, "store"]);
});