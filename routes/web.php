<?php

use App\Http\Controllers\PA\PAAuthController;
use App\Http\Controllers\PA\PABankController;
use App\Http\Controllers\PA\PACategoryController;
use App\Http\Controllers\PA\PACustomerController;
use App\Http\Controllers\PA\PADashboardController;
use App\Http\Controllers\PA\PAOrderController;
use App\Http\Controllers\PA\PAProductController;
use App\Http\Controllers\UA\UAAddressController;
use App\Http\Controllers\UA\UAAuthController;
use App\Http\Controllers\UA\UACartController;
use App\Http\Controllers\UA\UACheckoutController;
use App\Http\Controllers\UA\UADashboardController;
use App\Http\Controllers\UA\UAHomeController;
use App\Http\Controllers\UA\UAOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [UAHomeController::class, 'index'])->name('ua.home');
Route::get('/products', [UAHomeController::class, 'products'])->name('ua.products');
Route::get('/register', [UAAuthController::class, 'register'])->name('ua.register');
Route::post('/register', [UAAuthController::class, 'registerSubmit'])->name('ua.register.submit');

Route::get('/login', [UAAuthController::class, 'login'])->name('ua.login');
Route::post('/login', [UAAuthController::class, 'loginSubmit'])->name('ua.login.submit');

Route::post('/logout', [UAAuthController::class, 'logout'])->name('logout');


Route::post('/ua/cart/add', [UACartController::class, 'addToCart'])->name('ua.cart.add');
Route::get('/ua/cart/count', [UACartController::class, 'cartCount']);
Route::get('/ua/cart/list', [UACartController::class, 'getCartItems']);
Route::delete('/ua/cart/delete/{id}', [UACartController::class, 'deleteItem'])->middleware('auth');

Route::middleware(['auth'])->prefix('ua')->name('ua.')->group(function () {
    Route::get('/dashboard', [UADashboardController::class, 'index'])->name('dashboard');

    Route::prefix('address')->name('address.')->group(function () {
        Route::get('/', [UAAddressController::class, 'index'])->name('index');
        Route::post('/', [UAAddressController::class, 'store'])->name('store');
        Route::put('/{id}', [UAAddressController::class, 'update'])->name('update');
        Route::delete('/{id}', [UAAddressController::class, 'destroy'])->name('destroy');
    });

    Route::get('/orders', [UAOrderController::class, 'index'])->name('orders.index');

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [UACheckoutController::class, 'index'])->name('index');
        Route::post('/store', [UACheckoutController::class, 'store'])->name('store');
    });
});

Route::prefix('pa')->name('pa.')->group(function () {
    Route::get('/login', [PAAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [PAAuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware(['auth'])->prefix('pa')->name('pa.')->group(function () {
    Route::post('/logout', [PAAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PADashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [PACategoryController::class, 'index'])->name('index');
        Route::post('/store', [PACategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PACategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PACategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [PACategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [PAProductController::class, 'index'])->name('index');
        Route::get('/create', [PAProductController::class, 'create'])->name('create');
        Route::post('/', [PAProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PAProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PAProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [PAProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/pending', [PAOrderController::class, 'pending'])->name('pending');
        Route::get('/history', [PAOrderController::class, 'history'])->name('history');
        Route::get('/daily', [PAOrderController::class, 'daily'])->name('daily');
        Route::get('/daily/export', [PAOrderController::class, 'exportDailyPdf'])->name('daily.export');
        Route::get('/monthly', [PAOrderController::class, 'monthlyReport'])->name('monthly');
        Route::get('/monthly/export-pdf', [PAOrderController::class, 'exportMonthlyPdf'])->name('monthly.export');
        Route::get('/create', [PAOrderController::class, 'create'])->name('create');
        Route::post('/', [PAOrderController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PAOrderController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PAOrderController::class, 'update'])->name('update');
        Route::post('/{id}/update-status', [PAOrderController::class, 'updateStatus'])->name('update_status');
        Route::delete('/{id}', [PAOrderController::class, 'destroy'])->name('destroy');
        Route::get('/{order}', [PAOrderController::class, 'show'])->name('show');
    });

    Route::prefix('banks')->name('banks.')->group(function () {
        Route::get('/', [PABankController::class, 'index'])->name('index');
        Route::post('/', [PABankController::class, 'store'])->name('store');
        Route::get('/{bank}/edit', [PABankController::class, 'edit'])->name('edit');
        Route::put('/{bank}', [PABankController::class, 'update'])->name('update');
        Route::patch('/{bank}', [PABankController::class, 'update']);
        Route::delete('/{bank}', [PABankController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [PACustomerController::class, 'index'])->name('index');
        Route::get('/{id}', [PACustomerController::class, 'show'])->name('show');
        Route::delete('/{customer}', [PACustomerController::class, 'destroy'])->name('destroy');
    });
});
