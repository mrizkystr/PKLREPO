<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DataPsController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesCodesController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DataPsImportController;
use App\Http\Controllers\TargetGrowthController;
use App\Http\Controllers\Api\Admin\UserController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('layouts/app');
// });

Route::get('/index', function () {
    return view('index');
});

Route::get('/details', function () {
    return view('details');
});

// Route for the index page (showing 6 columns with pagination)
// Route::get('/data', [App\Http\Controllers\DataController::class, 'index'])->name('data.index');

// // Route for the details page (showing 52 columns when "View More" is clicked)
// Route::get('/data/{id}', [App\Http\Controllers\DataController::class, 'showDetails'])->name('data.show');

// Route::post('/import-data', [DataPsController::class, 'importExcel'])->name('import.data');

// Route::get('/import-excel', function() {
//     return view('import_excel');
// });

// Route::post('/import-excel', [DataPsController::class, 'importExcel']);

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
});

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

    // Route untuk import Excel
    Route::post('/import-excel', [DataPsController::class, 'importExcel'])->name('data-ps.import');


    Route::get('data-ps/target-tracking-and-sales-chart', [DataPsController::class, 'targetTrackingAndSalesChart'])->name('data-ps.target-tracking-and-sales-chart');
    Route::get('data-ps/growth-data', [DataPsController::class, 'showGrowthData'])->name('data-ps.growth-data');

    // Route untuk menyimpan atau memperbarui Target Growth
    Route::post('data-ps/save-target-growth', [DataPsController::class, 'saveTargetGrowth'])->name('data-ps.save-target-growth');
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
