<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesCodesController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Register manual
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import'); // Import Excel
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// DataPs routes
Route::prefix('data-ps')->group(function () {
    Route::get('/data', [DataPsController::class, 'index'])->name('data-ps.index');
    Route::get('/create', [DataPsController::class, 'create'])->name('data-ps.create');
    Route::post('/', [DataPsController::class, 'store'])->name('data-ps.store');
    Route::get('/{id}', [DataPsController::class, 'show'])->name('data-ps.show');
    Route::get('/{id}/edit', [DataPsController::class, 'edit'])->name('data-ps.edit');
    Route::put('/{id}', [DataPsController::class, 'update'])->name('data-ps.update');
    Route::delete('/{id}', [DataPsController::class, 'destroy'])->name('data-ps.destroy');

    // Route untuk analisis STO
    Route::get('/analysis/sto', [DataPsController::class, 'analysisBySto'])->name('data-ps.sto-analysis');
    Route::get('/data-ps/code-analysis', [DataPsController::class, 'analysisByCode'])->name('data-ps.code-analysis');
    Route::get('/data-ps/month-analysis', [DataPsController::class, 'analysisByMonth'])->name('data-ps.month-analysis');
    Route::get('/data-ps/mitra-analysis', [DataPsController::class, 'analysisByMitra'])->name('data-ps.mitra-analysis');
    Route::get('/data-ps/sto-chart', [DataPsController::class, 'stoChart'])->name('data-ps.sto-chart');
    Route::get('/data-ps/sto-pie-chart', [DataPsController::class, 'stoPieChart'])->name('data-ps.sto-pie-chart');
    Route::get('/data-ps/mitra-bar-chart', [DataPsController::class, 'mitraBarChartAnalysis'])->name('data-ps.mitra-bar-chart');
    Route::get('/data-ps/mitra-pie-chart', [DataPsController::class, 'mitraPieChartAnalysis'])->name('data-ps.mitra-pie-chart');
    Route::get('/data-ps/day-analysis', [DataPsController::class, 'dayAnalysis'])->name('data-ps.day-analysis');

    // Route untuk analisis target
    // Route::get('/data-ps/target-tracking', [DataPsController::class, 'targetTracking'])->name('data-ps.target-tracking');
    // Route::get('/data-ps/sales-chart', [DataPsController::class, 'salesChart'])->name('data-ps.sales-chart');

    Route::get('data-ps/target-tracking-and-sales-chart', [DataPsController::class, 'targetTrackingAndSalesChart'])->name('data-ps.target-tracking-and-sales-chart');

    // Route untuk import Excel
    Route::post('/import-excel', [DataPsController::class, 'importExcel'])->name('data-ps.import');
});


// SalesCode routes
Route::prefix('sales-codes')->group(function () {
    Route::get('/', [SalesCodesController::class, 'index'])->name('sales-codes.index');
    Route::post('/import-excel', [SalesCodesController::class, 'importExcel'])->name('sales-codes.import'); // Import route
    Route::get('/create', [SalesCodesController::class, 'create'])->name('sales-codes.create');
    Route::post('/', [SalesCodesController::class, 'store'])->name('sales-codes.store');
    Route::get('/{id}', [SalesCodesController::class, 'show'])->name('sales-codes.show');
    Route::get('/{id}/edit', [SalesCodesController::class, 'edit'])->name('sales-codes.edit');
    Route::put('/{id}', [SalesCodesController::class, 'update'])->name('sales-codes.update');
    Route::delete('/{id}', [SalesCodesController::class, 'destroy'])->name('sales-codes.destroy');
});
