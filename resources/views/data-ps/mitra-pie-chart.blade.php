<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Pie Chart - Data Management</title>
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
            background: linear-gradient(135deg, #eef2f3, #8e9eab);
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Sidebar Styling */
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        canvas {
            margin-top: 20px;
            width: 100% !important;
            height: auto !important;
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
        <a href="{{ route('data-ps.sto-chart') }}"
            class="sidebar-item @if (request()->routeIs('data-ps.sto-chart')) active @endif">Bar Chart Data</a>
        <a href="{{ route('data-ps.mitra-pie-chart') }}"
            class="sidebar-item @if (request()->routeIs('data-ps.mitra-pie-chart')) active @endif">Pie Chart Data</a>
        <!-- PS Overview Dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle sidebar-item" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                PS Overview
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('data-ps.sto-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.sto-analysis')) active @endif">
                    PS Analysis by STO
                </a>
                <a href="{{ route('data-ps.month-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.month-analysis')) active @endif">
                    PS Analysis By Month
                </a>
                <a href="{{ route('data-ps.code-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.code-analysis')) active @endif">
                    PS Analysis By Code
                </a>
                <a href="{{ route('data-ps.mitra-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.mitra-analysis')) active @endif">
                    PS Analysis by ID Mitra
                </a>
                <a href="{{ route('data-ps.day-analysis') }}"
                    class="dropdown-item @if (request()->routeIs('data-ps.day-analysis')) active @endif">
                    PS Data Analysis by Day
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Mitra Pie Chart</h1>

        <form method="GET" action="{{ route('data-ps.mitra-pie-chart') }}">
            <div class="form-group">
                <label for="bulan_ps">Pilih Bulan:</label>
                <select name="bulan_ps" id="bulan_ps" class="form-control">
                    <option value="">Semua Bulan</option>
                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                        <option value="{{ $month }}" {{ request('bulan_ps') === $month ? 'selected' : '' }}>
                            {{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <form method="GET" action="{{ route('data-ps.mitra-pie-chart') }}">
                <div class="form-group">
                    <label for="sto">Pilih STO:</label> <!-- Change the label to reflect STO selection -->
                    <select name="sto" id="sto" class="form-control">
                        <option value="">-- Pilih STO --</option>
                        @foreach ($stoList as $sto)
                            <!-- Assuming $stoList contains STOs from the backend -->
                            <option value="{{ $sto }}" {{ request('sto') == $sto ? 'selected' : '' }}>
                                {{ $sto }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

        <div class="chart-container">
            <canvas id="mitraChart"></canvas>
        </div>

        <script>
            var ctx = document.getElementById('mitraChart').getContext('2d');
            var mitraLabels = @json($mitraAnalysis->pluck('Mitra')); // Use Mitra as labels
            var mitraData = @json($mitraAnalysis->pluck('total')); // Use the Mitra data for the pie chart

            var mitraChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: mitraLabels,
                    datasets: [{
                        label: 'Mitra Data',
                        data: mitraData,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Mitra Pie Chart',
                            font: {
                                size: 24,
                                weight: 'bold'
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</body>

</html>
