<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PS Analysis by STO</title>

    <!-- Bootstrap CSS -->
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
            background: linear-gradient(135deg, #f3f4f6, #a2c2e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dropdown-menu {
            background: linear-gradient(180deg, #36d1dc, #5b86e5);
            /* Same as sidebar */
            border: none;
            /* Remove the default border */
            box-shadow: none;
            /* Remove the default shadow */
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: #007bff;
            /* Keep the hover effect consistent */
        }

        .sidebar a.active {
            background-color: #ffdd57;
            /* Highlight active item */
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

        .sidebar a.active {
            background-color: #ffdd57;
            color: white;
        }

        .sidebar .sidebar-brand {
            padding: 15px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
        }

        canvas {
            margin-top: 20px;
            width: 100% !important;
            height: auto !important;
        }

        .main-content {
            margin-left: 270px;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead th {
            background-color: #007bff !important;
            color: white !important;
            padding: 15px !important;
            text-align: center !important;
        }

        tbody td {
            padding: 15px;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e1f5fe;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
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


    <div class="main-content">
        <h1>Data Analysis PS by STO</h1>

        <!-- Filter Form -->
        <!-- Filter Form -->
        <form method="GET" action="{{ route('data-ps.sto-analysis') }}" class="mb-4">

            <div class="form-group">
                <label for="view_type">View Type:</label>
                <select name="view_type" id="view_type" class="form-control">
                    <option value="table" {{ $viewType == 'table' ? 'selected' : '' }}>Table</option>
                    <option value="chart" {{ $viewType == 'chart' ? 'selected' : '' }}>Chart</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sto">Select STO:</label>
                <select name="sto" id="sto" class="form-control">
                    <option value="all" {{ $selectedSto == 'all' ? 'selected' : '' }}>All STO</option>
                    @foreach ($stoList as $sto)
                        <option value="{{ $sto->STO }}" {{ $selectedSto == $sto->STO ? 'selected' : '' }}>
                            {{ $sto->STO }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>

        <!-- Conditional Rendering for Table or Chart -->
        @if ($viewType == 'table')
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STO</th>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoAnalysis as $analysis)
                            <tr>
                                <td>{{ $analysis->STO }}</td>
                                <td>{{ $analysis->total_januari }}</td>
                                <td>{{ $analysis->total_februari }}</td>
                                <td>{{ $analysis->total_maret }}</td>
                                <td>{{ $analysis->total_april }}</td>
                                <td>{{ $analysis->total_mei }}</td>
                                <td>{{ $analysis->total_juni }}</td>
                                <td>{{ $analysis->total_juli }}</td>
                                <td>{{ $analysis->total_agustus }}</td>
                                <td>{{ $analysis->total_september }}</td>
                                <td>{{ $analysis->total_oktober }}</td>
                                <td>{{ $analysis->total_november }}</td>
                                <td>{{ $analysis->total_desember }}</td>
                                <td>{{ $analysis->grand_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($viewType == 'chart')
            <canvas id="stoChart"></canvas>
            <script>
                var ctx = document.getElementById('stoChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                            'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: '{{ $selectedSto }}',
                            data: [
                                @foreach ($stoAnalysis as $analysis)
                                    {{ $analysis->total_januari }},
                                    {{ $analysis->total_februari }},
                                    {{ $analysis->total_maret }},
                                    {{ $analysis->total_april }},
                                    {{ $analysis->total_mei }},
                                    {{ $analysis->total_juni }},
                                    {{ $analysis->total_juli }},
                                    {{ $analysis->total_agustus }},
                                    {{ $analysis->total_september }},
                                    {{ $analysis->total_oktober }},
                                    {{ $analysis->total_november }},
                                    {{ $analysis->total_desember }}
                                @endforeach
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endif
    </div>
</body>

</html>
