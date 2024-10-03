<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    // Method untuk menampilkan data dengan 6 kolom dan pagination
    public function index(Request $request)
    {
        // Menggunakan simplePaginate untuk pagination tanpa ikon SVG
        $data = DB::table('data_ps_agustus_kujang_sql')->select(
            'id',
            'ORDER_ID',
            'REGIONAL',
            'WITEL',
            'DATEL',
            'STO'
        )->simplePaginate(10); // Menggunakan simplePaginate

        return view('index', compact('data'));
    }


    // Method untuk menampilkan detail 52 kolom berdasarkan ID
    public function showDetails($id)
    {
        // Ambil data detail berdasarkan ID
        $data = DB::table('data_ps_agustus_kujang_sql')->where('id', $id)->first();

        // Jika data ditemukan, kirim ke view details.blade.php
        if ($data) {
            return view('details', ['data' => (array) $data]); // Kirim semua kolom ke view details
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
