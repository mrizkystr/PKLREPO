<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target Tracking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6, #a2c2e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 260px;
            /* Push content to right to make space for sidebar */
            padding: 20px;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 30px auto;
            max-width: 800px;
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

        /* Center content for gap MTD */
        .row .col-lg-6 {
            margin-bottom: 40px;
        }

        h1 {
            text-align: center;
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

        <!-- New Dropdown for Sales Chart and Target Tracking -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle sidebar-item" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Trend Sales
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('data-ps.target-tracking') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.target-tracking')) active @endif">Target Tracking</a>
                <a href="{{ route('data-ps.sales-chart') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.sales-chart')) active @endif">Tracking Chart</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Target Tracking</h1>

        <!-- Month Filter -->
        <form method="GET" action="{{ route('data-ps.target-tracking') }}" class="text-right">
            <div class="form-group">
                <label for="bulan">Select Current Month:</label>
                <select class="form-control" id="bulan" name="bulan" onchange="this.form.submit()">
                    <option value="">-- Select Month --</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>
            </div>
        </form>

        @if ($selectedMonth)
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
                                    $cumulativeMTD = 0;
                                @endphp
                                @foreach ($currentMonthData as $data)
                                    @php
                                        $cumulativeMTD += $data->ps_harian;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->tgl }}</td>
                                        <td>{{ $data->ps_harian }}</td>
                                        <td>{{ $cumulativeMTD }}</td>
                                        <td>
                                            <select class="form-control" name="gimik_{{ $data->tgl }}">
                                                <option value="achieve">Achieve</option>
                                                <option value="not_achieve">Not Achieve</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Table (Previous Month) -->
                <div class="col-lg-6">
                    <div class="table-container">
                        <h3>Previous Month ({{ date('F', mktime(0, 0, 0, $selectedMonth - 1, 1)) }})</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Realisasi Bulan Lalu</th>
                                    <th>Realisasi MTD</th> <!-- Kolom untuk Realisasi MTD bulan lalu -->
                                    <th>GAP MTD</th> <!-- Kolom untuk GAP MTD -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cumulativeMTD = 0;
                                    $cumulativePreviousMTD = 0;
                                @endphp
                                @foreach ($currentMonthData as $index => $data)
                                    @php
                                        // Tambah PS Harian bulan ini ke MTD bulan ini
                                        $cumulativeMTD += $data->ps_harian;
                                        
                                        // Ambil data bulan lalu untuk tanggal yang sama
                                        $previousData = $previousMonthData[$index] ?? null;
                                        $previousDayPS = $previousData ? $previousData->ps_harian : 0;
                            
                                        // Tambah PS Harian bulan lalu ke MTD bulan lalu
                                        $cumulativePreviousMTD += $previousDayPS;
                            
                                        // Hitung GAP MTD (Realisasi bulan ini - Realisasi bulan lalu)
                                        $gapMTD = $cumulativeMTD - $cumulativePreviousMTD;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->tgl }}</td>
                                        <td>{{ $previousDayPS }}</td>
                                        <td>{{ $cumulativePreviousMTD }}</td>
                                        <td>{{ $gapMTD }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
