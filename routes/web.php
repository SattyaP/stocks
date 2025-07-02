<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::fallback(function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

    Route::get('items', App\Livewire\Items\Index::class)->name('items.index');
    Route::get('items/create', App\Livewire\Items\Create::class)->name('items.create');

    Route::get('suppliers', App\Livewire\Suppliers\Index::class)->name('suppliers.index');
    Route::get('management-stock', App\Livewire\ItemsLists\Index::class)->name('items.stock');
    Route::get('list-units', App\Livewire\Units\Index::class)->name('units.index');

    Route::get('add-unit', )->name('units.create');
});
