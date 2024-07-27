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
use Carbon\Carbon;
use App\Models\Categories;
use App\Models\Customer;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [LoginController::class, 'gate'])->name('login.gate');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'post'])->name('login.post');

Route::group(['middleware' => ['role:superadmin']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('sales', [SalesController::class, 'index'])->name('sales.index');

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
});

Route::group(['middleware' => ['role:cashier']], function(){
    Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
    Route::post('cashier/add-customer', [CashierController::class, 'addCustomer'])->name('cashier.addcustomer');
    Route::get('cashier/items/{category}', [CashierController::class, 'getItemsByCategory']);
    Route::get('cashier/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('cashier/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::get('cashier/pending-transaction', [PendingTransactionController::class, 'index'])->name('pending.transaction.index');
    Route::post('cashier/pending-transaction', [PendingTransactionController::class, 'store'])->name('pending.transaction.store');
    Route::get('/cashier/pending-transaction/{id}', [PendingTransactionController::class, 'getPendingTransaction']);
    Route::get('/cashier/show-pending-transaction', function () {
        $categories = Categories::all();
        $customers = Customer::all();
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('cashier.show', compact('dateTime','categories', 'customers')); // Adjust the path if necessary
    })->name('pending.transaction.show');

    Route::get('/receipt/{id}', [ReceiptController::class, 'showReceipt'])->name('receipt.show');
    Route::post('/sales/void', [SalesController::class, 'void'])->name('sales.void');
    Route::delete('cashier/pending-transaction/{id}', [PendingTransactionController::class, 'destroy'])->name('pending.transaction.delete');

});

Route::get('logout', [LoginController::class, 'logout'])->name('index.logout');
