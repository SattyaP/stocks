<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);

    Route::get('list-barang', [BarangController::class, 'listBarang'])->name('barang.list');
    Route::post('in-barang/{id}', [BarangController::class, 'inBarang'])->name('barang.in');
    Route::post('out-barang/{id}', [BarangController::class, 'outBarang'])->name('barang.out');

    Route::get('list-satuan', [SatuanController::class, 'index'])->name('satuan.index');
    Route::get('tambah-satuan', [SatuanController::class, 'create'])->name('satuan.create');
    Route::get('edit-satuan/{id}', [SatuanController::class, 'edit'])->name('satuan.edit');
    Route::post('store-satuan', [SatuanController::class, 'store'])->name('satuan.store');
    Route::put('update-satuan/{id}', [SatuanController::class, 'update'])->name('satuan.update');
    Route::delete('delete-satuan/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');

    Route::get('list-barang/filter-barang', [BarangController::class, 'filter'])->name('barang.filter');
    Route::get('list-barang/search', [BarangController::class, 'search'])->name('barang.search');
});


Route::fallback(function () {
    return redirect()->route('dashboard');
});
