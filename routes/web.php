<?php

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

Route::get('product/view', function () {
    return view('productview');
});




