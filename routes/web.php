<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PendingTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ExpendsController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SalesReceiptController;
use App\Http\Controllers\OmsetController;   


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'gate'])->name('login.gate');
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login', [LoginController::class, 'post'])->name('login.post');

    Route::group(['middleware' => ['role:superadmin']], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/dashboard/fetch-data', [DashboardController::class, 'fetchData'])->name('dashboard.fetchData');
        Route::post('/dashboard/export-excel', [DashboardController::class, 'exportExcel'])->name('dashboard.exportExcel');

        Route::get('/sales-summary', [DashboardController::class, 'salesSummary'])->name('sales.summary');
        Route::get('/sales-summary/filter', [DashboardController::class, 'getSalesByDate'])->name('sales.summary.getCategories');
        Route::get('/sales-summary/export', [DashboardController::class, 'exportSalesToExcel'])->name('sales.summary.export');

        Route::get('/receipts', [SalesReceiptController::class, 'index'])->name('sales.receipts.index');
        Route::get('/receipts/search', [SalesReceiptController::class, 'search'])->name('sales.receipts.search');
        Route::get('/receipts/{id}', [SalesReceiptController::class, 'show'])->name('sales.receipts.show');

        Route::get('items', [ItemsController::class, 'index'])->name('items.list.index');
        Route::get('items/add-items', [ItemsController::class, 'create'])->name('items.list.create');
        Route::post('items/add-items', [ItemsController::class, 'store'])->name('items.list.store');
        Route::get('/items/{item}/edit', [ItemsController::class, 'edit'])->name('items.edit');
        Route::post('/items/{item}/update', [ItemsController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemsController::class, 'destroy'])->name('items.destroy');

        Route::get('categories', [CategoriesController::class, 'index'])->name('items.category');
        Route::get('categories/add-categories', [CategoriesController::class, 'create'])->name('items.category.create');
        Route::post('categories/add-categories', [CategoriesController::class, 'store'])->name('items.category.store');
        Route::get('categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('items.category.edit');
        Route::post('categories/{categories}/update', [CategoriesController::class, 'update'])->name('items.category.update');
        Route::delete('categories/{categories}', [CategoriesController::class, 'destroy'])->name('items.category.destroy');

        Route::get('coupons', [CouponController::class, 'index'])->name('coupons.index');
        Route::get('coupons/add-coupons', [CouponController::class, 'create'])->name('coupons.create');
        Route::post('coupons/add-coupons', [CouponController::class, 'store'])->name('coupons.store');
        Route::get('/coupons/get-items-by-category/{categoryId}', [CouponController::class, 'getItemsByCategory']);
        Route::get('/coupons/{coupons}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::post('/coupons/{coupons}/update', [CouponController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/{coupons}', [CouponController::class, 'destroy'])->name('coupons.destroy');

        Route::get('/export-report', [OmsetController::class, 'export'])->name('export.report');


    });

    Route::group(['middleware' => ['role:cashier']], function(){
        Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::post('cashier/add-customer', [CashierController::class, 'addCustomer'])->name('cashier.addcustomer');
        Route::get('cashier/get-customer/{id}', [CashierController::class, 'getCustomer'])->name('cashier.getcustomer');
        Route::get('cashier/items/{category}', [CashierController::class, 'getItemsByCategory']);
        Route::get('/cashier/closed/print/{date}', [CashierController::class, 'printReceipt'])->name('cashier.printReceipt');
        Route::get('cashier/close', [CashierController::class, 'close'])->name('cashier.close');

        Route::get('cashier/sales', [SalesController::class, 'index'])->name('sales.index');
        Route::post('cashier/sales', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/cashier/sales/{saleId}/receipt', [SalesController::class, 'getReceipt'])->name('sales.receipt');
        Route::post('/sales/void', [SalesController::class, 'void'])->name('sales.void');

        Route::get('cashier/pending-transaction', [PendingTransactionController::class, 'index'])->name('pending.transaction.index');
        Route::post('cashier/pending-transaction', [PendingTransactionController::class, 'store'])->name('pending.transaction.store');
        Route::get('/cashier/pending-transaction/{id}', [PendingTransactionController::class, 'getPendingTransaction']);
        Route::get('/cashier/show-pending-transaction/{id}', [PendingTransactionController::class, 'show'])->name('pending.transaction.show');
        Route::get('/cashier/show-pending-transaction/coupon/{coupon}', [PendingTransactionController::class, 'getCoupon']);
        Route::get('/cashier/show-pending-transaction/item/{item}', [PendingTransactionController::class, 'getItem']);
        Route::delete('/cashier/pending-transaction/{id}', [PendingTransactionController::class, 'destroy'])->name('pending.transaction.destroy');

        Route::get('cashier/expends', [ExpendsController::class, 'index'])->name('expends.index');
        Route::get('cashier/expends/add-expends', [ExpendsController::class, 'create'])->name('expends.create');
        Route::post('cashier/expends/add-expends', [ExpendsController::class, 'store'])->name('expends.store');
        Route::get('/cashier/expends/{expends}/edit', [ExpendsController::class, 'edit'])->name('expends.edit');
        Route::delete('/cashier/expends/{id}',[ExpendsController::class, 'delete'])->name('expends.delete');

        Route::get('/cashier/coupons/{coupons}',[CouponController::class, 'getCoupons'])->name('coupons.get');

        Route::get('/receipt/{id}', [ReceiptController::class, 'showReceipt'])->name('receipt.show');
        // Route::delete('cashier/pending-transaction/{id}', [PendingTransactionController::class, 'destroy'])->name('pending.transaction.delete');

    });

    Route::get('logout', [LoginController::class, 'logout'])->name('index.logout');

});


