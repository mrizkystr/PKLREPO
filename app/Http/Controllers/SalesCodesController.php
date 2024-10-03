<?php

namespace App\Http\Controllers;

use App\Models\SalesCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SalesCodesImport;

class SalesCodesController extends Controller
{
    public function index()
    {
        $salesCodes = SalesCodes::simplepaginate(10);
        return view('sales-codes.index', compact('salesCodes'));
    }

    public function create()
    {
        return view('sales-codes.create');
    }

    // Menyimpan data ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'mitra_nama' => 'nullable|string',
            'nama' => 'nullable|string',
            'sto' => 'nullable|string',
            'id_mitra' => 'nullable|string',
            'nama_mitra' => 'nullable|string',
            'role' => 'nullable|string',
            'kode_agen' => 'nullable|string',
            'kode_baru' => 'nullable|string',
            'no_telp_valid' => 'nullable|string',
            'nama_sa_2' => 'nullable|string',
            'status_wpi' => 'nullable|string',
        ]);

        // Membuat SalesCode baru
        SalesCodes::create($request->all());

        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('sales-codes.store')->with('success', 'Sales code berhasil ditambahkan!');
    }

    public function show($id)
    {
        $salesCode = SalesCodes::findOrFail($id);
        return view('sales-codes.show', compact('salesCode'));
    }

    public function edit($id)
    {
        $salesCode = SalesCodes::findOrFail($id);
        return view('sales-codes.edit', compact('salesCode'));
    }

    public function update(Request $request, $id)
    {
        $salesCode = SalesCodes::findOrFail($id);

        $validatedData = $request->validate([
            'mitra_nama' => 'required',
            'nama' => 'required',
            'sto' => 'required',
            'id_mitra' => 'required|integer',
            'nama_mitra' => 'required',
            'role' => 'required',
            'kode_agen' => 'required',
            'kode_baru' => 'required',
            'no_telp_valid' => 'required',
            'nama_sa_2' => 'required',
            'status_wpi' => 'required',
        ]);

        $salesCode->update($validatedData);
        return redirect()->route('sales-codes.index')->with('success', 'Sales Code updated successfully.');
    }

    public function destroy($id)
    {
        $salesCode = SalesCodes::findOrFail($id);
        $salesCode->delete();
        return redirect()->route('sales-codes.index')->with('success', 'Sales Code deleted successfully.');
    }

    public function importExcel(Request $request)
    {
        Log::info('Starting file upload process...');
        Log::info('Request details:', $request->all());

        if (!$request->hasFile('file')) {
            Log::error('No file uploaded.');
            return response()->json(['error' => 'No file uploaded.'], 422);
        }

        $file = $request->file('file');

        $allowedExtensions = ['xlsx', 'xls', 'csv'];
        if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
            Log::error('Invalid file extension.');
            return response()->json(['error' => 'Invalid file extension.'], 422);
        }

        Log::info('File details:', [
            'name' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $file->getRealPath(),
        ]);

        try {
            DB::beginTransaction();

            $import = new SalesCodesImport;
            Excel::import($import, $file);

            DB::commit();

            $rowsImported = $import->getRowCount();
            $totalRows = $import->rows;

            Log::info("Data import successful! Rows imported: $rowsImported");

            return response()->json([
                'message' => "Data imported successfully! Rows imported: $rowsImported",
                'total_rows_processed' => $totalRows,
                'empty_rows_skipped' => $totalRows - $rowsImported,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error importing data: ' . $e->getMessage());
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}
