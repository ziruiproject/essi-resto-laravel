<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\Menu;
use App\Livewire\ShowMenu;
use App\Livewire\TransactionFailed;
use App\Livewire\TransactionSuccess;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/carts', Cart::class)->name('show.cart');
Route::get('/checkout/{id}', Checkout::class)->name('checkout');
Route::get('/menu', Menu::class)->name('index.menu');
Route::get('/menu/{id}', ShowMenu::class)->name('show.menu');

Route::get('/transaction/{id}/success', TransactionSuccess::class)->name('transaction.success');
Route::get('/transaction/{id}/failed', TransactionFailed::class)->name('transaction.failed');

Route::post('/carts/add', [CartController::class, 'store'])->name('store.cart');

Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
