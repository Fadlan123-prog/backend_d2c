<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoriesController;

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
    Route::get('/items/{category}', [CashierController::class, 'getItemsByCategory']);
});

Route::get('logout', [LoginController::class, 'logout'])->name('index.logout');
