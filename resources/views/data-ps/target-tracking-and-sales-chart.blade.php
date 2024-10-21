<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target Tracking and Sales Chart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h3 {
            margin-top: 0;
            color: #333;
        }

        .table-container {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        canvas {
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        label {
            margin-right: 10px;
            font-weight: bold;
        }

        select {
            margin-right: 20px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-lg-6 {
            width: 48%;
            margin-bottom: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .col-lg-6 {
                width: 100%;
            }

            form {
                flex-direction: column;
                align-items: flex-start;
            }

            select {
                margin-bottom: 10px;
            }
        }

        /* Sidebar Styling */
        .dropdown-menu {
            background: linear-gradient(180deg, #36d1dc, #5b86e5);
            border: none;
            box-shadow: none;
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: #007bff;
        }

        .sidebar a.active {
            background-color: #ffdd57;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: linear-gradient(180deg, #36d1dc, #5b86e5);
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .sidebar .sidebar-brand {
            padding: 15px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">Data Management</div>
        <a href="/dashboard" class="sidebar-item">Dashboard</a>
        <a href="{{ route('data-ps.index') }}" class="sidebar-item @if (request()->routeIs('data-ps.index')) active @endif">Data
            PS</a>
        <a href="{{ route('sales-codes.index') }}"
            class="sidebar-item @if (request()->routeIs('sales-codes.index')) active @endif">Sales Codes</a>

        <!-- Dropdown for STO Charts -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle sidebar-item" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                STO Charts
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('data-ps.sto-chart') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.sto-chart')) active @endif">STO Chart</a>
                <a href="{{ route('data-ps.sto-pie-chart') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.sto-pie-chart')) active @endif">STO Pie Chart</a>
            </div>
        </div>

        <!-- Dropdown for Mitra Charts -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle sidebar-item" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Mitra Charts
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('data-ps.mitra-bar-chart') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.mitra-bar-chart')) active @endif">Mitra Chart</a>
                <a href="{{ route('data-ps.mitra-pie-chart') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.mitra-pie-chart')) active @endif">Mitra Pie Chart</a>
            </div>
        </div>

        <!-- PS Overview Dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle sidebar-item" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                PS Overview
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('data-ps.sto-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.sto-analysis')) active @endif">PS Analysis by STO</a>
                <a href="{{ route('data-ps.month-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.month-analysis')) active @endif">PS Analysis By Month</a>
                <a href="{{ route('data-ps.code-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.code-analysis')) active @endif">PS Analysis By Code</a>
                <a href="{{ route('data-ps.mitra-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.mitra-analysis')) active @endif">PS Analysis by ID Mitra</a>
                <a href="{{ route('data-ps.day-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.day-analysis')) active @endif">PS Data Analysis by Day</a>
            </div>
        </div>

        <a href="{{ route('data-ps.target-tracking-and-sales-chart') }}"
            class="sidebar-item @if (request()->routeIs('data-ps.target-tracking-and-sales-chart')) active @endif">Trend Sales</a>
    </div>

    <div class="container">
        <form method="GET" action="{{ route('data-ps.target-tracking-and-sales-chart') }}">
            <label for="bulan">Select Month:</label>
            <select name="bulan" id="bulan" onchange="this.form.submit()">
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $month == $selectedMonth ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                    </option>
                @endforeach
            </select>

            <label for="view_type">View Type:</label>
            <select name="view_type" id="view_type" onchange="this.form.submit()">
                <option value="table" {{ $viewType == 'table' ? 'selected' : '' }}>Table</option>
                <option value="chart" {{ $viewType == 'chart' ? 'selected' : '' }}>Chart</option>
            </select>
        </form>

        @if ($selectedMonth)
            @if ($viewType == 'table')
                <div class="row">
                    <!-- Left Table (Current Month) -->
                    <div class="col-lg-6">
                        <div class="table-container">
                            <h3>Current Month ({{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }})</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>PS Harian</th>
                                        <th>Realisasi MTD</th>
                                        <th>Gimik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cumulativeMTD = 0; // Untuk menyimpan total MTD untuk bulan berjalan
                                    @endphp
                                    @foreach ($dataToDisplayCurrentMonth as $currentData)
                                        @php
                                            $cumulativeMTD += $currentData['ps_harian']; // Menambahkan ps_harian ke cumulative
                                        @endphp
                                        <tr>
                                            <td>{{ $currentData['tgl'] }}</td>
                                            <td>{{ $currentData['ps_harian'] }}</td>
                                            <td>{{ $cumulativeMTD }}</td>
                                            <td>{{ $currentData['gimmick'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right Table (Previous Month) -->
                    <div class="col-lg-6">
                        <div class="table-container">
                            <h3>Previous Month ({{ date('F', mktime(0, 0, 0, $previousMonth, 1)) }})</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Realisasi Bulan Lalu</th>
                                        <th>Realisasi MTD Bulan Lalu</th>
                                        <th>GAP MTD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cumulativeMTDPrev = 0; // Total MTD bulan sebelumnya
                                        $cumulativeMTDCurrent = 0; // Total MTD bulan sekarang
                                    @endphp
                                    @foreach ($dataToDisplayPreviousMonth as $index => $prevData)
                                        @php
                                            // Hitung cumulative untuk bulan sekarang
                                            $cumulativeMTDCurrent += $dataToDisplayCurrentMonth[$index]['ps_harian'];
                                            // Hitung cumulative untuk bulan sebelumnya
                                            $cumulativeMTDPrev += $prevData['realisasi_bulan_lalu'];
                                            // Hitung GAP MTD
                                            $gapMTD = $cumulativeMTDCurrent - $cumulativeMTDPrev;
                                        @endphp
                                        <tr>
                                            <td>{{ $prevData['tgl'] }}</td>
                                            <td>{{ $prevData['realisasi_bulan_lalu'] }}</td>
                                            <td>{{ $cumulativeMTDPrev }}</td>
                                            <td
                                                style="
                            @if ($gapMTD > 0) background-color: #4CAF50; 
                                color: white;
                            @elseif($gapMTD < 0)
                                background-color: #f44336;
                                color: white;
                            @else
                                background-color: #DCDCDC;
                                color: black; @endif
                        ">
                                                {{ number_format($gapMTD, 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($viewType == 'chart')
                    <canvas id="salesChart"></canvas>
                    <script>
                        const ctx = document.getElementById('salesChart').getContext('2d');
                        const salesChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode($labels) !!},
                                datasets: [{
                                    label: 'Current Month (Realisasi MTD)',
                                    data: {!! json_encode(array_column($dataToDisplayCurrentMonth, 'realisasi_mtd')) !!},
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    fill: true,
                                    tension: 0.4
                                }, {
                                    label: 'Previous Month (Realisasi MTD)',
                                    data: {!! json_encode(array_column($dataToDisplayPreviousMonth, 'realisasi_mtd_bulan_lalu')) !!},
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    fill: true,
                                    tension: 0.4
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Sales'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Days'
                                        }
                                    }
                                }
                            }
                        });
                    </script>
            @endif
        @endif
    </div>
</body>

</html>
