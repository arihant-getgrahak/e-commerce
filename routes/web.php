<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
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

        Route::get('bulk', function () {
            return view('adminproductbulk');
        })->name('bulk');
    });

    Route::group(['prefix' => '/attribute'], function () {
        // attributes
        Route::get('/', [AttributeController::class, 'index'])->name('attribute');
        Route::post('add', [AttributeController::class, 'store'])->name('attribute.add');
        Route::post('update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::delete('delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete');

        // attributes values
        Route::post('value/add', [AttributeController::class, 'storeAttributeValues'])->name('attribute.value.add');
        Route::post('value/update/{id}', [AttributeController::class, 'updateAttributeValues'])->name('attribute.value.update');
        Route::delete('value/delete/{id}', [AttributeController::class, 'destroyAttributeValues'])->name('attribute.value.delete');
    });

    Route::group(['prefix' => '/admin/address'], function () {
        Route::get('/', [AdminController::class, 'country'])->name('admin.country');
        Route::get('state/{id}', [AdminController::class, 'getState'])->name('admin.state');
        Route::get('city/{id}', [AdminController::class, 'getCity'])->name('admin.city');
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

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('cart/add', [CartController::class, 'store'])->name('cart.add');

Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('cart/json', [CartController::class, 'cartcount'])->name('cartcount');

Route::get('/my-orders', [CheckoutController::class, 'display'])->name('my-orders');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('wishlist/delete/{id}', [WishlistController::class, 'destroy'])->name('wishlist.delete');
Route::get('wishlist/count', [WishlistController::class, 'display'])->name('wishlist.count');

Route::post('price/filter', [ProductController::class, 'pricefilter'])->name('price.filter');

Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/facebook/redirect', [AuthController::class, 'redirectToFacebook'])->name('facebook.redirect');
Route::get('/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('facebook.callback');

Route::get('/admin/order', [AdminController::class, 'index'])->name('admin.order');
Route::post('admin/order/update/{id}', [AdminController::class, 'update'])->name('admin.order.update');
Route::post('/admin/search', [AdminController::class, 'search'])->name('admin.search');

Route::get('/invoice/{id}', [AdminController::class, 'download'])->name('invoice');

Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');

Route::get('/admin/user/login/{id}', [AdminController::class, 'loginascustomer'])->name('admin.user.login');

Route::get('/order/track/{id}', [AdminController::class, 'track'])->name('order.track');

Route::get('/address', [ProductController::class, 'address'])->name('address');

Route::post('/bulk/import', [AdminController::class, 'importCSV'])->name('admin.bulk.import');

Route::get('search', [SearchController::class, 'search'])->name('search');

Route::post('/country/update', [AdminController::class, 'addressUpdate'])->name('country.update');
Route::post('/state/update', [AdminController::class, 'stateUpdate'])->name('state.update');
Route::post('/city/update', [AdminController::class, 'cityUpdate'])->name('city.update');

Route::get('/address/available', [AdminController::class, 'checkAddress'])->name('address.available');
