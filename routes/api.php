<?php

// use App\Http\Controllers\AuthController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ParentCategoryController;
// use App\Http\Controllers\ChildCategoryController;
// use App\Http\Controllers\BrandController;
// use App\Http\Controllers\ReviewController;


// Route::group(["prefix" => "product"], function () {
//     Route::get("/", [ProductController::class, "display"]);
//     Route::get("/{id}", [ProductController::class, "specific"]);
//     Route::post("/store", [ProductController::class, "store"]);
//     Route::post("/update/{id}", [ProductController::class, "update"]);
//     Route::delete("/delete/{id}", [ProductController::class, "delete"]);
// });

// Route::group(["prefix" => "category"], function () {
//     Route::get("/", [ParentCategoryController::class, "display"]);
//     Route::post("/store", [ParentCategoryController::class, "store"]);
//     Route::post("/update/{id}", [ParentCategoryController::class, "update"]);
//     Route::delete("/delete/{id}", [ParentCategoryController::class, "delete"]);
// });

// Route::group(["prefix" => "category/child"], function () {
//     Route::get("/", [ChildCategoryController::class, "display"]);
//     Route::post("/store", [ChildCategoryController::class, "store"]);
//     Route::post("/update/{id}", [ChildCategoryController::class, "update"]);
//     Route::delete("/delete/{id}", [ChildCategoryController::class, "delete"]);
// });

// Route::group(["prefix" => "brand"], function () {
//     Route::get("/", [BrandController::class, "display"]);
//     Route::post("/store", [BrandController::class, "store"]);
//     Route::post("/update/{id}", [BrandController::class, "update"]);
//     Route::delete("/delete/{id}", [BrandController::class, "delete"]);
// });

// Route::group(["prefix" => "review"], function () {
//     Route::get("/{id}", [ReviewController::class, "display"]);
//     Route::post("/store", [ReviewController::class, "store"]);
// });

// Route::post("/register", [AuthController::class, "register"]);