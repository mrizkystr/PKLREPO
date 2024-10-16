<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesCodesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [LoginController::class, 'index']);
// Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:api');

// Route::get('/dashboard', [DashboardController::class, 'dashboard']);

// Route::prefix('data-ps')->group(function () {
    
//     // CRUD Routes (Index, Show, Create, Store, Edit, Update, Destroy)
//     Route::get('/', [DataPsController::class, 'index']); // Menampilkan data PS (pagination)
//     Route::get('/{id}', [DataPsController::class, 'show']); // Menampilkan detail data PS berdasarkan ID
//     Route::post('/', [DataPsController::class, 'store']); // Menyimpan data baru
//     Route::put('/{id}', [DataPsController::class, 'update']); // Mengupdate data berdasarkan ID
//     Route::delete('/{id}', [DataPsController::class, 'destroy']); // Menghapus data berdasarkan ID
    
//     // Route untuk Import Data
//     Route::post('/import', [DataPsController::class, 'importExcel']); // Import data dari file Excel

//     // Analisis dan Chart Routes
//     Route::get('/analysis/sto', [DataPsController::class, 'analysisBySto']); // Analisis berdasarkan STO
//     Route::get('/analysis/month', [DataPsController::class, 'analysisByMonth']); // Analisis berdasarkan Bulan
//     Route::get('/analysis/code', [DataPsController::class, 'analysisByCode']); // Analisis berdasarkan Kode
//     Route::get('/analysis/mitra', [DataPsController::class, 'analysisByMitra']); // Analisis berdasarkan Mitra

//     // Route untuk STO Chart
//     Route::get('/charts/sto', [DataPsController::class, 'stoChart']); // Chart STO berdasarkan bulan dan mitra

//     // Route untuk Mitra Pie Chart
//     Route::get('/charts/mitra-pie', [DataPsController::class, 'mitraPieChartAnalysis']); // Analisis Mitra dengan Pie Chart

//     // Route untuk analisis per hari (berdasarkan tanggal dan bulan)
//     Route::get('/analysis/day', [DataPsController::class, 'dayAnalysis']); // Analisis data berdasarkan hari
// });

// Route::prefix('sales-codes')->group(function () {
    
//     // CRUD Routes
//     Route::get('/', [SalesCodesController::class, 'index'])->name('sales-codes.index'); // Menampilkan semua sales codes dengan paginasi
//     Route::get('/{id}', [SalesCodesController::class, 'show'])->name('sales-codes.show'); // Menampilkan detail sales code berdasarkan ID
//     Route::post('/', [SalesCodesController::class, 'store'])->name('sales-codes.store'); // Menyimpan sales code baru
//     Route::put('/{id}', [SalesCodesController::class, 'update'])->name('sales-codes.update'); // Mengupdate sales code berdasarkan ID
//     Route::delete('/{id}', [SalesCodesController::class, 'destroy'])->name('sales-codes.destroy'); // Menghapus sales code berdasarkan ID
    
//     // Route untuk Import Excel
//     Route::post('/import', [SalesCodesController::class, 'importExcel'])->name('sales-codes.import'); // Meng-import data dari file Excel
// });