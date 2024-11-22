<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\DashboardController as DashboardAdminController;
use App\Http\Controllers\Admin\TransactionController;
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

Route::get('/', [DashboardController::class, 'viewDashboardPage'])->name('dashboard.page');
Route::get('/admin', [DashboardAdminController::class, 'viewDashboardPage'])->name('admin-dashboard.page');
Route::get('/search/{order_by}/{asc}', [SearchController::class, 'viewSearchPage'])->name('search.page');
Route::get('/login', [LoginController::class, 'viewLoginpage'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login.action');
Route::get('/register', [RegisterController::class, 'viewRegisterPage'])->name('register.page');
Route::post('/register', [RegisterController::class, 'register'])->name('register.action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.page');

Route::put('update-transaction-header/{id}', [TransactionController::class, 'updateTransactionHeader'])->name('update-transaction-header.action');
Route::delete('delete-transaction-header/{transactionHeader}', [TransactionController::class, 'deleteTransactionHeader'])->name('delete-transaction-header.action');

Route::get('/product-category/{product_category}', [])->name('product-category.page');
Route::get('/product/{product}', [ProductController::class, 'viewProductDetailPage'])->name('product-detail.page');

Route::post('/add-to-cart/{cart}/{product}', [CartController::class, 'addToCart'])->name('add-to-cart.action');
Route::get('/cart', [CartController::class, 'viewCartPage'])->name('cart.page');

Route::put('/update-cart-item/{cart_item}/{status}', [CartController::class, 'updateCartItem'])->name('update-cart-item.action');
Route::delete('/delete-cart-item/{cart_item}', [CartController::class, 'deleteCartItem'])->name('delete-cart-item.action');

Route::prefix('/cart')->group(function () {
    Route::put('/increment/{cart_item}', [CartController::class, 'incrementCartItem'])->name('update-cart-item.increment.action');
    Route::put('/decrement/{cart_item}', [CartController::class, 'decrementCartItem'])->name('update-cart-item.decrement.action');
});

Route::view('/TermsAndConditions','companyInfo.termsandconditions')->name('termsandconditions.page');
Route::view('/PrivacyPolicy','companyInfo.privacypolicy')->name('privacypolicy.page');