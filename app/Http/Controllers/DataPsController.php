<?php

// app/Http/Controllers/DataPsController.php
namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\DataPsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataPsAgustusKujangSql;

class DataPsController extends Controller
{
    public function index()
    {
        $data = DataPsAgustusKujangSql::select('id', 'ORDER_ID', 'REGIONAL', 'WITEL', 'DATEL', 'STO')
            ->simplepaginate(10);
        return view('data-ps.index', compact('data'));
    }

    public function show($id)
    {
        $item = DataPsAgustusKujangSql::findOrFail($id);
        return view('data-ps.show', compact('item'));
    }

    public function analysisBySto(Request $request)
    {
        // Mengambil data per STO dengan total data PS per bulan (Januari sampai Desember)
        $stoAnalysis = DataPsAgustusKujangSql::select(
            'STO',
            DB::raw('sum(case when Bulan_PS = "Januari" then 1 else 0 end) as total_januari'),
            DB::raw('sum(case when Bulan_PS = "Februari" then 1 else 0 end) as total_februari'),
            DB::raw('sum(case when Bulan_PS = "Maret" then 1 else 0 end) as total_maret'),
            DB::raw('sum(case when Bulan_PS = "April" then 1 else 0 end) as total_april'),
            DB::raw('sum(case when Bulan_PS = "Mei" then 1 else 0 end) as total_mei'),
            DB::raw('sum(case when Bulan_PS = "Juni" then 1 else 0 end) as total_juni'),
            DB::raw('sum(case when Bulan_PS = "Juli" then 1 else 0 end) as total_juli'),
            DB::raw('sum(case when Bulan_PS = "Agustus" then 1 else 0 end) as total_agustus'),
            DB::raw('sum(case when Bulan_PS = "September" then 1 else 0 end) as total_september'),
            DB::raw('sum(case when Bulan_PS = "Oktober" then 1 else 0 end) as total_oktober'),
            DB::raw('sum(case when Bulan_PS = "November" then 1 else 0 end) as total_november'),
            DB::raw('sum(case when Bulan_PS = "Desember" then 1 else 0 end) as total_desember'),
            DB::raw('sum(1) as grand_total')
        ) // Grand total untuk semua bulan
            ->groupBy('STO')
            ->orderBy('STO', 'asc')
            ->get();

        return view('data-ps.sto-analysis', compact('stoAnalysis'));
    }

    public function analysisByMonth(Request $request)
    {
        $bulan = $request->input('bulan_ps'); // Ambil bulan dari request

        // Ambil analisis bulan dan STO
        $monthAnalysis = DataPsAgustusKujangSql::select('Bulan_PS', 'STO', DB::raw('count(*) as total'))
            ->when($bulan, function ($query) use ($bulan) {
                return $query->where('Bulan_PS', $bulan);
            })
            ->groupBy('Bulan_PS', 'STO') // Mengelompokkan berdasarkan Bulan dan STO
            ->orderBy('Bulan_PS', 'asc') // Atur urutan bulan
            ->orderBy('STO', 'asc') // Atur urutan STO
            ->get();

        return view('data-ps.month-analysis', compact('monthAnalysis', 'bulan'));
    }

    // Analisis per Kode
    public function analysisByCode(Request $request)
    {
        // Ambil bulan dari request
        $bulanPs = $request->input('bulan_ps');

        // Base query
        $query = DataPsAgustusKujangSql::select(
            'data_ps_agustus_kujang_sql.Bulan_PS',
            'data_ps_agustus_kujang_sql.STO',
            'data_ps_agustus_kujang_sql.Kode_sales',
            'data_ps_agustus_kujang_sql.Nama_SA', // Menambahkan Nama_SA dari tabel sales_codes
            DB::raw("
            CASE 
                WHEN data_ps_agustus_kujang_sql.Bulan_PS = 'Agustus' THEN sales_codes.kode_agen
                WHEN data_ps_agustus_kujang_sql.Bulan_PS = 'September' THEN sales_codes.kode_baru
                ELSE NULL
            END as kode_selected
        "),
            DB::raw("COUNT(DISTINCT data_ps_agustus_kujang_sql.id) as total")
        )
            ->leftJoin('sales_codes', function ($join) {
                $join->on('data_ps_agustus_kujang_sql.STO', '=', 'sales_codes.sto')
                    ->on(function ($query) {
                        $query->where('data_ps_agustus_kujang_sql.Bulan_PS', 'Agustus')
                            ->whereColumn('data_ps_agustus_kujang_sql.Kode_sales', 'sales_codes.kode_agen')
                            ->orWhere('data_ps_agustus_kujang_sql.Bulan_PS', 'September')
                            ->whereColumn('data_ps_agustus_kujang_sql.Kode_sales', 'sales_codes.kode_baru');
                    });
            });

        // Apply bulan filter if selected
        if ($bulanPs) {
            $query->where('data_ps_agustus_kujang_sql.Bulan_PS', $bulanPs);
        }

        // Group and order the results
        $codeAnalysis = $query->groupBy(
            'data_ps_agustus_kujang_sql.Bulan_PS',
            'data_ps_agustus_kujang_sql.STO',
            'data_ps_agustus_kujang_sql.Kode_sales',
            'data_ps_agustus_kujang_sql.Nama_SA', // Group by Nama_SA
            DB::raw('kode_selected')
        )
            ->orderBy('data_ps_agustus_kujang_sql.Bulan_PS', 'asc')
            ->orderBy('data_ps_agustus_kujang_sql.STO', 'asc')
            ->orderBy('kode_selected', 'asc')
            ->get();

        // Organize and combine data
        $organizedData = [];
        foreach ($codeAnalysis as $item) {
            $key = $item->kode_selected ?? $item->Kode_sales;
            if (!isset($organizedData[$key])) {
                $organizedData[$key] = [
                    'kode' => $key,
                    'nama' => $item->Nama_SA, // Include Nama_SA
                    'total' => 0
                ];
            }
            $organizedData[$key]['total'] += $item->total;
        }

        // Sort the organized data by total (descending)
        uasort($organizedData, function ($a, $b) {
            return $b['total'] - $a['total'];
        });

        return view('data-ps.code-analysis', [
            'analysisPerCode' => $organizedData,
            'selectedBulan' => $bulanPs
        ]);
    }

    public function analysisByMitra(Request $request)
    {
        // Ambil input dari request
        $bulanPs = $request->input('bulan_ps');
        $selectedMitra = $request->input('mitra'); // Input untuk filter Mitra
        $selectedSto = $request->input('sto'); // Input untuk filter STO

        // Jika bulan_ps berbentuk nama bulan seperti 'Agustus', normalisasi input
        $bulanPs = ucfirst(strtolower($bulanPs));

        // Ambil daftar Mitra untuk ditampilkan di dropdown
        $mitraList = DataPsAgustusKujangSql::when($selectedSto, function ($query) use ($selectedSto) {
            // Filter Mitra berdasarkan STO yang dipilih
            return $query->where('STO', $selectedSto);
        })->distinct()->pluck('Mitra');

        // Ambil daftar STO untuk ditampilkan di dropdown
        $stoList = DataPsAgustusKujangSql::distinct()->pluck('STO');

        // Query untuk analisis berdasarkan bulan, STO, dan mitra
        $mitraAnalysis = DataPsAgustusKujangSql::select(
            'data_ps_agustus_kujang_sql.Mitra',
            DB::raw('COUNT(DISTINCT data_ps_agustus_kujang_sql.id) as total')
        )
            ->when($bulanPs, function ($query) use ($bulanPs) {
                // Filter berdasarkan nama bulan di kolom Bulan_PS
                return $query->where('Bulan_PS', $bulanPs);
            })
            ->when($selectedSto, function ($query) use ($selectedSto) {
                // Filter berdasarkan STO yang dipilih
                return $query->where('STO', $selectedSto);
            })
            ->when($selectedMitra, function ($query) use ($selectedMitra) {
                // Filter berdasarkan Mitra yang dipilih
                return $query->where('Mitra', $selectedMitra);
            })
            ->groupBy('Mitra')
            ->orderBy('Mitra', 'asc')
            ->get();

        // Kirim data ke view
        return view('data-ps.mitra-analysis', compact('stoList', 'mitraList', 'selectedSto', 'selectedMitra', 'bulanPs', 'mitraAnalysis'));
    }

    public function stoChart(Request $request)
    {
        // Ambil bulan dari request
        $bulanPs = $request->input('bulan_ps');
        $selectedMitra = $request->input('id_mitra');

        // Fetching data for chart with filters
        $data = DataPsAgustusKujangSql::select('STO', DB::raw('count(*) as total'))
            ->when($bulanPs, function ($query) use ($bulanPs) {
                return $query->where('Bulan_PS', $bulanPs);
            })
            ->when($selectedMitra, function ($query) use ($selectedMitra) {
                return $query->where('Mitra', $selectedMitra);
            })
            ->groupBy('STO')
            ->get();

        // Mengambil label dan data dari hasil query
        $stoLabels = $data->pluck('STO');
        $stoData = $data->pluck('total');

        // Mengirim variabel yang benar ke view
        return view('data-ps.sto-chart', [
            'labels' => $stoLabels,
            'data' => $stoData,
            'bulan_ps' => $bulanPs,
            'id_mitra' => $selectedMitra,
            'mitraList' => DataPsAgustusKujangSql::distinct()->pluck('Mitra'), // List for filtering
        ]);
    }

    public function stoPieChart(Request $request)
    {
        // Ambil bulan dan Mitra dari request
        $bulanPs = $request->input('bulan_ps');
        $selectedMitra = $request->input('id_mitra');

        // Fetching data for pie chart with filters
        $data = DataPsAgustusKujangSql::select('STO', DB::raw('count(*) as total'))
            ->when($bulanPs, function ($query) use ($bulanPs) {
                return $query->where('Bulan_PS', $bulanPs);
            })
            ->when($selectedMitra, function ($query) use ($selectedMitra) {
                return $query->where('Mitra', $selectedMitra);
            })
            ->groupBy('STO')
            ->get();

        // Mengambil label dan data dari hasil query
        $stoLabels = $data->pluck('STO');
        $stoData = $data->pluck('total');

        // Mengirim variabel ke view untuk pie chart
        return view('data-ps.sto-pie-chart', [
            'labels' => $stoLabels,
            'data' => $stoData,
            'bulan_ps' => $bulanPs,
            'id_mitra' => $selectedMitra,
            'mitraList' => DataPsAgustusKujangSql::distinct()->pluck('Mitra'), // List for filtering
        ]);
    }

    public function mitraBarChartAnalysis(Request $request)
    {
        $selectedSto = $request->input('sto'); // Mengambil STO yang dipilih
        $bulanPs = $request->input('bulan_ps'); // Opsional, jika ingin memfilter berdasarkan bulan juga

        // Mengambil daftar STO unik untuk dropdown form
        $stoList = DataPsAgustusKujangSql::distinct()->pluck('STO');

        // Mengambil data Mitra berdasarkan STO yang dipilih
        $mitraAnalysis = DataPsAgustusKujangSql::select(
            'Mitra', // Group by Mitra
            DB::raw("COUNT(DISTINCT id) as total") // Menghitung total item unik per Mitra
        )
            ->when($bulanPs, function ($query) use ($bulanPs) {
                return $query->where('Bulan_PS', $bulanPs);
            })
            ->when($selectedSto, function ($query) use ($selectedSto) {
                return $query->where('STO', $selectedSto); // Filter berdasarkan STO
            })
            ->groupBy('Mitra') // Mengelompokkan data berdasarkan Mitra
            ->get();

        // Menyiapkan data untuk ditampilkan dalam format yang sesuai untuk bar chart
        $labels = $mitraAnalysis->pluck('Mitra')->toArray(); // Mengambil daftar nama Mitra sebagai label
        $totals = $mitraAnalysis->pluck('total')->toArray(); // Mengambil jumlah total sebagai data untuk chart

        // Return view dengan data analisis Mitra dan daftar STO untuk form
        return view('data-ps.mitra-bar-chart', compact('stoList', 'selectedSto', 'labels', 'totals'));
    }

    public function mitraPieChartAnalysis(Request $request)
    {
        $selectedSto = $request->input('sto'); // Get the selected STO
        $bulanPs = $request->input('bulan_ps'); // Optional if you want to filter by month too

        // Fetch list of STOs to populate the form dropdown
        $stoList = DataPsAgustusKujangSql::distinct()->pluck('STO');

        // Fetch Mitra data based on the selected STO
        $mitraAnalysis = DataPsAgustusKujangSql::select(
            'Mitra', // Group by Mitra instead of STO
            DB::raw("COUNT(DISTINCT id) as total")
        )
            ->when($bulanPs, function ($query) use ($bulanPs) {
                return $query->where('Bulan_PS', $bulanPs);
            })
            ->when($selectedSto, function ($query) use ($selectedSto) {
                return $query->where('STO', $selectedSto); // Filter by STO
            })
            ->groupBy('Mitra') // Group by Mitra to display in the chart
            ->get();

        // Return view with the Mitra analysis and STO list for the form
        return view('data-ps.mitra-pie-chart', compact('stoList', 'selectedSto', 'mitraAnalysis'));
    }

    public function dayAnalysis(Request $request)
    {
        // Get available months for the dropdown
        $allDates = DataPsAgustusKujangSql::selectRaw('DATE_FORMAT(TGL_PS, "%Y-%m") as month')
            ->distinct()
            ->pluck('month');

        $availableMonths = $allDates->toArray();

        // Get filter inputs
        $tanggal_ps = $request->input('tanggal_ps');
        $bulan_ps = $request->input('bulan_ps');

        // Base query
        $query = DataPsAgustusKujangSql::query();

        // Filter by date
        if ($tanggal_ps) {
            $query->whereDate('TGL_PS', $tanggal_ps);
        }

        // Filter by month
        if ($bulan_ps) {
            $query->whereYear('TGL_PS', Carbon::parse($bulan_ps)->year)
                ->whereMonth('TGL_PS', Carbon::parse($bulan_ps)->month);
        }

        // Select data for analysis by day, only displaying TGL_PS first
        $dayAnalysis = $query->selectRaw('DATE(TGL_PS) as tanggal')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Jika request berasal dari Ajax untuk menampilkan detail
        if ($request->ajax()) {
            $tglDetail = $request->input('tanggal');
            $detailData = DataPsAgustusKujangSql::whereDate('TGL_PS', $tglDetail)
                ->select('ORDER_ID', 'CUSTOMER_NAME', 'STO', 'Nama_SA', 'ADDON')
                ->get();

            return response()->json($detailData); // Kembalikan data sebagai JSON
        }

        return view('data-ps.day-analysis', compact('dayAnalysis', 'tanggal_ps', 'bulan_ps', 'availableMonths'));
    }

    public function targetTracking(Request $request)
    {
        // Get selected month or use current month as default
        $selectedMonth = $request->input('bulan', now()->month);

        // Fetch data for the current month (left table)
        $currentMonthData = DataPsAgustusKujangSql::select(
            DB::raw('DATE(TGL_PS) as tgl'),
            DB::raw('COUNT(*) as ps_harian')
        )
            ->whereMonth('TGL_PS', $selectedMonth)
            ->groupBy(DB::raw('DATE(TGL_PS)'))
            ->orderBy('tgl') // Ensure sorting by date
            ->get();

        // Calculate Previous Month
        $previousMonth = $selectedMonth == 1 ? 12 : $selectedMonth - 1;

        // Fetch data for the previous month (right table)
        $previousMonthData = DataPsAgustusKujangSql::select(
            DB::raw('DATE(TGL_PS) as tgl'),
            DB::raw('COUNT(*) as ps_harian')
        )
            ->whereMonth('TGL_PS', $previousMonth)
            ->groupBy(DB::raw('DATE(TGL_PS)'))
            ->orderBy('tgl') // Ensure sorting by date
            ->get();

        // Create an associative array for the previous month data for easier access
        $previousMonthArray = [];
        foreach ($previousMonthData as $data) {
            $previousMonthArray[$data->tgl] = $data->ps_harian;
        }

        // Prepare data for calculating GAP MTD
        $gapMTD = [];
        foreach ($currentMonthData as $currentData) {
            $currentDate = $currentData->tgl;
            $previousDataValue = $previousMonthArray[$currentDate] ?? 0; // Default to 0 if no previous data
            $gapMTD[$currentDate] = $currentData->ps_harian - $previousDataValue; // Calculate GAP MTD
        }

        // Calculate total realizations for the previous month
        $realisasiBulanLalu = $previousMonthData->sum('ps_harian');

        return view('data-ps.target-tracking', compact('currentMonthData', 'previousMonthData', 'gapMTD', 'selectedMonth', 'realisasiBulanLalu'));
    }

    // New function to handle the chart diagram
    public function salesChart(Request $request)
    {
        // Dapatkan bulan yang dipilih atau gunakan bulan saat ini sebagai default
        $selectedMonth = $request->input('bulan_ps') ? date('n', strtotime($request->input('bulan_ps'))) : now()->month;

        // Ambil data untuk bulan yang dipilih (misalnya Agustus)
        $currentMonthData = DataPsAgustusKujangSql::select(
            DB::raw('DAY(TGL_PS) as day'),
            DB::raw('COUNT(*) as ps_harian')
        )
            ->whereMonth('TGL_PS', $selectedMonth)
            ->groupBy(DB::raw('DAY(TGL_PS)'))
            ->orderBy('day')
            ->get();

        // Hitung bulan sebelumnya
        $previousMonth = $selectedMonth == 1 ? 12 : $selectedMonth - 1;

        // Ambil data untuk bulan sebelumnya (misalnya Juli)
        $previousMonthData = DataPsAgustusKujangSql::select(
            DB::raw('DAY(TGL_PS) as day'),
            DB::raw('COUNT(*) as ps_harian')
        )
            ->whereMonth('TGL_PS', $previousMonth)
            ->groupBy(DB::raw('DAY(TGL_PS)'))
            ->orderBy('day')
            ->get();

        // Siapkan data kumulatif untuk bulan saat ini
        $currentMonthCumulative = [];
        $currentSum = 0;

        foreach ($currentMonthData as $data) {
            $currentSum += $data->ps_harian;
            $currentMonthCumulative[] = $currentSum;
        }

        // Siapkan data kumulatif untuk bulan sebelumnya
        $previousMonthCumulative = [];
        $previousSum = 0;

        foreach ($previousMonthData as $data) {
            $previousSum += $data->ps_harian;
            $previousMonthCumulative[] = $previousSum;
        }

        // Pastikan bahwa jika tidak ada data untuk bulan sebelumnya, tetap tambahkan array dengan nol
        if ($previousMonthCumulative == []) {
            $previousMonthCumulative = array_fill(0, count($currentMonthCumulative), 0);
        }

        // Siapkan label untuk grafik (hari dalam bulan)
        $labels = range(1, 31); // Asumsi maksimum 31 hari

        // Kembalikan tampilan dengan data grafik
        return view('data-ps.sales-chart', [
            'currentMonthCumulative' => $currentMonthCumulative,
            'previousMonthCumulative' => $previousMonthCumulative,
            'labels' => $labels,
            'selectedMonth' => $selectedMonth,
            'previousMonth' => $previousMonth,
        ]);
    }

    public function create()
    {
        return view('data-ps.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ORDER_ID' => 'required|unique:data_ps_agustus_kujang_sql,ORDER_ID',
            'REGIONAL' => 'required|string|max:255',
            'WITEL' => 'nullable|string|max:100',
            'DATEL' => 'nullable|string|max:100',
            'STO' => 'nullable|string|max:10',
            'UNIT' => 'nullable|string|max:10',
            'JENISPSB' => 'nullable|string|max:50',
            'TYPE_TRANS' => 'nullable|string|max:50',
            'TYPE_LAYANAN' => 'nullable|string|max:50',
            'STATUS_RESUME' => 'nullable|string|max:255',
            'PROVIDER' => 'nullable|string|max:100',
            'ORDER_DATE' => 'nullable|date',
            'LAST_UPDATED_DATE' => 'nullable|date',
            'NCLI' => 'nullable|string|max:50',
            'POTS' => 'nullable|string|max:50',
            'SPEEDY' => 'nullable|string|max:50',
            'CUSTOMER_NAME' => 'nullable|string|max:255',
            'LOC_ID' => 'nullable|string|max:50',
            'WONUM' => 'nullable|string|max:50',
            'FLAG_DEPOSIT' => 'nullable|string|max:10',
            'CONTACT_HP' => 'nullable|string|max:20',
            'INS_ADDRESS' => 'nullable|string',
            'GPS_LONGITUDE' => 'nullable|string|max:50',
            'GPS_LATITUDE' => 'nullable|string|max:50',
            'KCONTACT' => 'nullable|string',
            'CHANNEL' => 'nullable|string|max:100',
            'STATUS_INET' => 'nullable|string|max:50',
            'STATUS_ONU' => 'nullable|string|max:50',
            'UPLOAD' => 'nullable|string|max:50',
            'DOWNLOAD' => 'nullable|string|max:50',
            'LAST_PROGRAM' => 'nullable|string|max:100',
            'STATUS_VOICE' => 'nullable|string|max:50',
            'CLID' => 'nullable|string|max:500',
            'LAST_START' => 'nullable|date',
            'TINDAK_LANJUT' => 'nullable|string',
            'ISI_COMMENT' => 'nullable|string',
            'USER_ID_TL' => 'nullable|string|max:50',
            'TGL_COMMENT' => 'nullable|date',
            'TANGGAL_MANJA' => 'nullable|date',
            'KELOMPOK_KENDALA' => 'nullable|string|max:100',
            'KELOMPOK_STATUS' => 'nullable|string|max:100',
            'HERO' => 'nullable|string|max:50',
            'ADDON' => 'nullable|string|max:50',
            'TGL_PS' => 'nullable|date',
            'STATUS_MESSAGE' => 'nullable|string|max:50',
            'PACKAGE_NAME' => 'nullable|string|max:100',
            'GROUP_PAKET' => 'nullable|string|max:100',
            'REASON_CANCEL' => 'nullable|string',
            'KETERANGAN_CANCEL' => 'nullable|string',
            'TGL_MANJA' => 'nullable|date',
            'DETAIL_MANJA' => 'nullable|string',
            'Bulan_PS' => 'nullable|string|max:50',
            'Kode_sales' => 'nullable|string|max:50',
            'Nama_SA' => 'nullable|string|max:255',
            'Mitra' => 'nullable|string|max:100',
            'Ekosistem' => 'nullable|string|max:100',
            // Include all other fields from your database table
        ]);

        // Mengecek apakah ORDER_ID sudah ada di database
        $existingOrder = DataPsAgustusKujangSql::where('ORDER_ID', $request->ORDER_ID)->first();
        if ($existingOrder) {
            return redirect()->back()->withErrors(['ORDER_ID' => 'ORDER_ID sudah digunakan.']);
        }

        // Simpan data ke database jika validasi lolos
        DataPsAgustusKujangSql::create($validatedData);

        // Redirect ke halaman index atau halaman lain setelah penyimpanan
        return redirect()->route('data-ps.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = DataPsAgustusKujangSql::findOrFail($id);
        return view('data-ps.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = DataPsAgustusKujangSql::findOrFail($id);

        $validatedData = $request->validate([
            'ORDER_ID' => 'nullable|unique:data_ps_agustus_kujang_sql,ORDER_ID',
            'REGIONAL' => 'required|string|max:255',
            'WITEL' => 'nullable|string|max:100',
            'DATEL' => 'nullable|string|max:100',
            'STO' => 'nullable|string|max:10',
            'UNIT' => 'nullable|string|max:10',
            'JENISPSB' => 'nullable|string|max:50',
            'TYPE_TRANS' => 'nullable|string|max:50',
            'TYPE_LAYANAN' => 'nullable|string|max:50',
            'STATUS_RESUME' => 'nullable|string|max:255',
            'PROVIDER' => 'nullable|string|max:100',
            'ORDER_DATE' => 'nullable|date',
            'LAST_UPDATED_DATE' => 'nullable|date',
            'NCLI' => 'nullable|string|max:50',
            'POTS' => 'nullable|string|max:50',
            'SPEEDY' => 'nullable|string|max:50',
            'CUSTOMER_NAME' => 'nullable|string|max:255',
            'LOC_ID' => 'nullable|string|max:50',
            'WONUM' => 'nullable|string|max:50',
            'FLAG_DEPOSIT' => 'nullable|string|max:10',
            'CONTACT_HP' => 'nullable|string|max:20',
            'INS_ADDRESS' => 'nullable|string',
            'GPS_LONGITUDE' => 'nullable|string|max:50',
            'GPS_LATITUDE' => 'nullable|string|max:50',
            'KCONTACT' => 'nullable|string',
            'CHANNEL' => 'nullable|string|max:100',
            'STATUS_INET' => 'nullable|string|max:50',
            'STATUS_ONU' => 'nullable|string|max:50',
            'UPLOAD' => 'nullable|string|max:50',
            'DOWNLOAD' => 'nullable|string|max:50',
            'LAST_PROGRAM' => 'nullable|string|max:100',
            'STATUS_VOICE' => 'nullable|string|max:50',
            'CLID' => 'nullable|string|max:500',
            'LAST_START' => 'nullable|date',
            'TINDAK_LANJUT' => 'nullable|string',
            'ISI_COMMENT' => 'nullable|string',
            'USER_ID_TL' => 'nullable|string|max:50',
            'TGL_COMMENT' => 'nullable|date',
            'TANGGAL_MANJA' => 'nullable|date',
            'KELOMPOK_KENDALA' => 'nullable|string|max:100',
            'KELOMPOK_STATUS' => 'nullable|string|max:100',
            'HERO' => 'nullable|string|max:50',
            'ADDON' => 'nullable|string|max:50',
            'TGL_PS' => 'nullable|date',
            'STATUS_MESSAGE' => 'nullable|string|max:50',
            'PACKAGE_NAME' => 'nullable|string|max:100',
            'GROUP_PAKET' => 'nullable|string|max:100',
            'REASON_CANCEL' => 'nullable|string',
            'KETERANGAN_CANCEL' => 'nullable|string',
            'TGL_MANJA' => 'nullable|date',
            'DETAIL_MANJA' => 'nullable|string',
            'Bulan_PS' => 'nullable|string|max:50',
            'Kode_sales' => 'nullable|string|max:50',
            'Nama_SA' => 'nullable|string|max:255',
            'Mitra' => 'nullable|string|max:100',
            'Ekosistem' => 'nullable|string|max:100',
            // Include all other fields from your database table
        ]);
        $item->update($validatedData);
        return redirect()->route('data-ps.index')->with('success', 'Data PS updated successfully.');
    }

    public function destroy($id)
    {
        $item = DataPsAgustusKujangSql::findOrFail($id);
        $item->delete();
        return redirect()->route('data-ps.index')->with('success', 'Data PS deleted successfully.');
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

        Log::info('File details:', [
            'name' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $file->getRealPath(),
        ]);

        try {
            DB::beginTransaction();

            $import = new DataPsImport;
            Excel::import($import, $file);

            $rowsImported = $import->getRowCount();

            DB::commit();
            Log::info("Data import successful! Rows imported: $rowsImported");
            return response()->json(['message' => "Data imported successfully! Rows imported: $rowsImported"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error importing data: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}
