<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| This file defines the routing conventions for the web application.
|
| **GET Routes:**
| - Each GET route must have a corresponding controller method.
| - The naming convention for these methods should follow the pattern:
|   a 'view' prefix and a 'Page' suffix.
|   Example: 
|   - viewDashboardPage
|   - viewLoginPage
|   - viewSettingsPage
|
| - Each GET route must also have a defined route name that ends with the 'page' suffix.
|   Example:
|   - dashboard.page
|   - login.page
|   - create.product.page
|
| **POST, PUT, PATCH, DELETE Routes:**
| - There are no specific naming conventions for controller methods for these routes, but 
|   it is recommended to use an action verb as a prefix, such as 'get', 'store', 'update', 'delete'.
| - However, each route must have a defined route name that ends with the 'action' suffix.
|   Example:
|   - login.action
|   - create.product.action
|   - update.product.action
|
| Please adhere to these conventions to maintain consistency and clarity in the codebase.
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'viewLoginpage'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.action');
    Route::get('/register', [RegisterController::class, 'viewRegisterPage'])->name('register.page');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.action');
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout.page');

    Route::get('/checkout', [CartController::class, 'viewCheckoutPage'])->name('checkout.page');

    Route::put('/update-shipping-provider', [CartController::class, 'updateShippingProvider'])->name('update-shipping-provider.action');
    
    Route::get('/profile',[ProfileController::class,'viewProfilePage'])->name('profile.page');
    
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::get('/profile/addresses',[ProfileController::class,'viewProfileAddressesPage'])->name('profileAddresses.page');
    
    Route::put('/profile/addresses/{id}', [ProfileController::class, 'updateAddresses'])->name('profileAddresses.update');

    Route::post('profile/addresses/insert',[ProfileController::class,'addAddresses'])->name('profileAddresses.insert'); 
    
    Route::prefix('voucher')->group(function () {
        Route::get('/use/{voucher}', [VoucherController::class, 'getVoucher'])->name('use-voucher.page');
        Route::post('/use', [VoucherController::class, 'useVoucher'])->name('use-voucher.action');
    });

    Route::prefix('/cart')->group(function () {
        Route::get('/', [CartController::class, 'viewCartPage'])->name('cart.page');

        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.action');
        Route::post('/add-to-cart/{cart}/{product}', [CartController::class, 'addToCart'])->name('add-to-cart.action');

        Route::put('/increment/{cart_item}', [CartController::class, 'incrementCartItem'])->name('update-cart-item.increment.action');
        Route::put('/decrement/{cart_item}', [CartController::class, 'decrementCartItem'])->name('update-cart-item.decrement.action');
        Route::put('/update-cart-item/{cart_item}/{status}', [CartController::class, 'updateCartItem'])->name('update-cart-item.action');

        Route::delete('/delete-cart-item/{cart_item}', [CartController::class, 'deleteCartItem'])->name('delete-cart-item.action');
    });

});

Route::middleware(AdminMiddleware::class)->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminPageController::class, 'viewDashboardPage'])->name('admin-dashboard.page');
    Route::prefix('/product')->group(function (){
        Route::get('/', [AdminPageController::class, 'viewProductPage'])->name('admin-product.page');
        Route::post('/', [ProductController::class, 'storeCreatedProduct'])->name('create.product.action');
        Route::get('/create', [ProductController::class, 'createProduct'])->name('create.product.page');
        Route::delete('/delete/{product}', [ProductController::class, 'deleteProduct'])->name('delete-product.action');
        Route::get('/update/{product}', [AdminPageController::class, 'viewUpdateProductPage'])->name('update-product.page');
        Route::put('/update/{product}', [ProductController::class, 'updateProduct'])->name('update-product.action');
    });
    Route::put('/update-transaction-header/{id}', [TransactionController::class, 'updateTransactionHeader'])->name('update-transaction-header.action');
    Route::delete('/delete-transaction-header/{transactionHeader}', [TransactionController::class, 'deleteTransactionHeader'])->name('delete-transaction-header.action');
});

Route::get('/', [DashboardController::class, 'viewDashboardPage'])->name('dashboard.page');
Route::get('/search', [SearchController::class, 'viewSearchPage'])->name('search.page');

Route::get('/product/{product}', [ProductController::class, 'viewProductDetailPage'])->name('product-detail.page');

Route::view('/TermsAndConditions', 'guest.terms-and-conditions')->name('termsandconditions.page');
Route::view('/PrivacyPolicy', 'guest.privacy-policy')->name('privacypolicy.page');
Route::view('/About', 'guest.about')->name('about.page');

Route::prefix('/product-category')->group(function () {
    Route::get('/label/{label}', [ProductCategoryController::class, 'viewProductCategoryByLabelPage'])->name('product-category-by-label.page');
    Route::get('/category/{category}', [ProductCategoryController::class, 'viewProductCategoryByCategoryPage'])->name('product-category-by-category.page');
});
