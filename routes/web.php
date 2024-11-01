<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WasteController;
use App\Http\Controllers\WastePriceCostController; // Tambahkan baris ini

Route::get('/', function () {
    return view('welcome');
});

// Route untuk Waste
Route::get('/api/waste', [WasteController::class, 'index']);
Route::get('/api/waste/{id}', [WasteController::class, 'show']);
Route::get('/api/waste/by-parent/{id}', [WasteController::class, 'parent']);

// Route untuk WastePriceCost
Route::get('/waste-price-cost/create', [WastePriceCostController::class, 'create'])->name('waste-price-cost.create');
Route::post('/waste-price-cost', [WastePriceCostController::class, 'store'])->name('waste-price-cost.store');
Route::get('/waste-price-cost/{id}/edit', [WastePriceCostController::class, 'edit'])->name('waste-price-cost.edit');
Route::put('/waste-price-cost/{id}', [WastePriceCostController::class, 'update'])->name('waste-price-cost.update'); // Tambahkan route update
Route::delete('/waste-price-cost/{id}', [WastePriceCostController::class, 'destroy'])->name('waste-price-cost.destroy'); // Tambahkan route destroy
