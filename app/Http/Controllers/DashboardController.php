<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\DataPsAgustusKujangSql;
use App\Models\SalesCodes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Pastikan tabel SalesCodes dan DataPsAgustusKujangSql ada
        $totalSalesCodes = SalesCodes::count(); // Mendapatkan jumlah total sales codes
        $totalOrders = DataPsAgustusKujangSql::count(); // Mendapatkan total order
        $completedOrders = DataPsAgustusKujangSql::where('STATUS_MESSAGE', 'completed')->count(); // Order selesai
        $pendingOrders = DataPsAgustusKujangSql::where('STATUS_MESSAGE', 'pending')->count(); // Order pending

        // Recent data fetch
        $recentSalesCodes = SalesCodes::latest()->take(5)->get();
        $recentOrders = DataPsAgustusKujangSql::orderBy('ORDER_ID', 'desc')->take(5)->get();

        // Kirim variabel ke view
        return view('layouts.app', compact('totalSalesCodes', 'totalOrders', 'completedOrders', 'pendingOrders', 'recentSalesCodes', 'recentOrders'));
    }
}

