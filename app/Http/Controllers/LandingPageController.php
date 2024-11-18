<?php

namespace App\Http\Controllers;

use App\Models\DataPsAgustusKujangSql;
use App\Models\SalesCodes;

class LandingPageController extends Controller
{
    public function index()
    {
        // Data untuk landing page
        $totalSalesCodes = SalesCodes::count();
        $totalOrders = DataPsAgustusKujangSql::count();
        $completedOrders = DataPsAgustusKujangSql::where('STATUS_MESSAGE', 'completed')->count();
        $pendingOrders = DataPsAgustusKujangSql::where('STATUS_MESSAGE', 'pending')->count();

        // Kirim data ke view
        return view('welcome', compact('totalSalesCodes', 'totalOrders', 'completedOrders', 'pendingOrders'));
    }
}
