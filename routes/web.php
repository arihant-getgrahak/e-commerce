<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PickupAddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LangMiddleware;
use App\Http\Middleware\TrackUtmMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => LangMiddleware::class], function () {
    Route::group(['middleware' => TrackUtmMiddleware::class], function () {
        Route::group(['middleware' => AdminMiddleware::class], function () {

            Route::get('admin', function () {
                return view('admin');
            })->name('admin');

            Route::group(['prefix' => '/admin'], function () {
                Route::group(['prefix' => '/product'], function () {
                    Route::get('category', [CategoryController::class, 'index'])->name('category');

                    Route::get('add', [ProductController::class, 'index'])->name('product.add.view');

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

                Route::group(['prefix' => '/address'], function () {
                    Route::get('/country', [AdminController::class, 'country'])->name('admin.country');
                    Route::get('/state', [AdminController::class, 'state'])->name('admin.state');
                    Route::get('/city', [AdminController::class, 'city'])->name('admin.city');
                    Route::get('/state/{id}', [AdminController::class, 'getState'])->name('admin.state.list');
                    Route::get('/pickup', [PickupAddressController::class, 'index'])->name('pickupaddress');
                });

                Route::get('/navigation', [NavigationController::class, 'index'])->name('admin.navigation');

                Route::get('/order', [AdminController::class, 'index'])->name('admin.order');

                Route::group(['prefix' => '/customer'], function () {
                    Route::get('/', [AdminController::class, 'user'])->name('admin.user');
                    Route::get('/login/{id}', [AdminController::class, 'loginascustomer'])->name('admin.user.login');
                });

                Route::get('/order/{id}', [AdminController::class, 'orderspeicific'])->name('order.specific');

                Route::group(['prefix' => '/setting'], function () {
                    Route::get('/shiprocket', action: [AdminSettingController::class, 'shiprocketView'])->name('admin.setting.shiprocket');
                    Route::get('/forex', action: [AdminSettingController::class, 'forexView'])->name('admin.setting.forexView');
                    Route::get('/store', action: [AdminSettingController::class, 'storeView'])->name('admin.setting.store');
                    Route::get('/language', action: [AdminSettingController::class, 'languageView'])->name('admin.setting.language');
                });
            });
        });

        Route::get('/child-category/{id}', [ProductController::class, 'child_category'])->name('child-category');

        Route::get('login', [AuthController::class, 'loginView'])->name('login');

        Route::get('register', [AuthController::class, 'registerView'])->name('register');

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('category/add', [CategoryController::class, 'store'])->name('category.add');
        Route::post('category/child/add', [CategoryController::class, 'storechild'])->name('category.child.add');
        Route::post('brand/add', [BrandController::class, 'store'])->name('brand.add');
        Route::post('/product/add', [ProductController::class, 'store'])->name('product.add');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
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

        Route::post('admin/order/update/{id}', [AdminController::class, 'update'])->name('admin.order.update');
        Route::post('/admin/search', [AdminController::class, 'search'])->name('admin.search');

        Route::get('/invoice/{id}', [AdminController::class, 'invoice'])->name('invoice');
        Route::get('/print/{id}/{printerId}', [AdminController::class, 'printNode'])->name('printNode');

        Route::get('/order/track/{id}', [AdminController::class, 'track'])->name('order.track');

        Route::get('/address', [ProductController::class, 'address'])->name('address');

        Route::post('/bulk/import', [AdminController::class, 'importCSV'])->name('admin.bulk.import');

        Route::get('search', [SearchController::class, 'search'])->name('search');

        Route::post('/country/update', [AdminController::class, 'addressUpdate'])->name('country.update');
        Route::post('/state/update', [AdminController::class, 'stateUpdate'])->name('state.update');
        Route::post('/city/update/{id}', [AdminController::class, 'cityUpdate'])->name('city.update');

        Route::get('/address/available', [AdminController::class, 'checkAddress'])->name('address.available');

        Route::get('/track-order', [AdminController::class, 'track_order'])->name('track.order');

        Route::post('/city/add', [AdminController::class, 'addCity'])->name('city.add');

        Route::delete('/city/delete/{id}', [AdminController::class, 'deleteCity'])->name('city.delete');

        Route::get('/links/{id}', [NavigationController::class, 'getLinks'])->name('links');
        Route::post('/link', [NavigationController::class, 'store'])->name('link.add');
        Route::post('/menu', [NavigationController::class, 'addMenu'])->name('menu.add');

        Route::get('/getPrinter', [AdminController::class, 'getPrinters'])->name('getPrinter');

        Route::post('/pickup/store', [PickupAddressController::class, 'store'])->name('pickupaddress.create');
        Route::post('/pickup/update/{id}', [PickupAddressController::class, 'update'])->name('pickupaddress.update');
        Route::delete('/pickup/delete/{id}', [PickupAddressController::class, 'delete'])->name('pickupaddress.delete');

        Route::post('/update/globalCountry', [AdminController::class, 'updateGlobalCountry'])->name('update.global.country');

        Route::post('/admin/shiprocket/update', [AdminSettingController::class, 'changeCredentials'])->name('admin.shiprocket.update');

        Route::post('/menu/sort', [NavigationController::class, 'changeOrder'])->name('menu.sort');

        Route::post('/admin/setting/store/add', [AdminSettingController::class, 'adminStore'])->name('admin.setting.store.create');
        Route::delete('/admin/setting/store/delete/{id}', [AdminSettingController::class, 'storeDelete'])->name(name: 'admin.setting.store.delete');
        Route::put('/admin/setting/store/update/{id}', [AdminSettingController::class, 'storeUpdate'])->name(name: 'admin.setting.store.update');

        Route::post('/admin/setting/forex/add', [AdminSettingController::class, 'forexStore'])->name('admin.setting.forex.create');
        Route::put('/admin/setting/forex/update/{id}', [AdminSettingController::class, 'forexUpdate'])->name(name: 'admin.setting.forex.update');
        Route::delete('/admin/setting/forex/delete/{id}', [AdminSettingController::class, 'forexDelete'])->name(name: 'admin.setting.forex.delete');

        Route::post('/admin/setting/language/add', [LangController::class, 'languageStore'])->name('admin.setting.language.create');
        Route::delete('/admin/setting/language/delete/{id}', [LangController::class, 'languageDelete'])->name(name: 'admin.setting.language.delete');

        Route::post('/admin/setting/forex/default/currency', [AdminSettingController::class, 'defaultCurrency'])->name('admin.setting.forex.currency.default');
        Route::post('/admin/setting/store/forex/option', [AdminSettingController::class, 'forexOption'])->name('admin.setting.forex.option');

        Route::post('/lang/change', [LangController::class, 'changeLang'])->name('lang.change');
    });
});
