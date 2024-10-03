<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STO Chart - Data Management</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            overflow-x: hidden;
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
        <h1>STO Analysis Chart</h1>

        <!-- Month and ID Mitra Filters -->
        <form method="GET" action="{{ route('data-ps.sto-chart') }}">
            <div class="form-group">
                <label for="bulan_ps">Pilih Bulan:</label>
                <select name="bulan_ps" id="bulan_ps" class="form-control">
                    <option value="">Semua Bulan</option>
                    <option value="Januari" {{ request('bulan_ps') === 'Januari' ? 'selected' : '' }}>Januari</option>
                    <option value="Februari" {{ request('bulan_ps') === 'Februari' ? 'selected' : '' }}>Februari
                    </option>
                    <option value="Maret" {{ request('bulan_ps') === 'Maret' ? 'selected' : '' }}>Maret</option>
                    <option value="April" {{ request('bulan_ps') === 'April' ? 'selected' : '' }}>April</option>
                    <option value="Mei" {{ request('bulan_ps') === 'Mei' ? 'selected' : '' }}>Mei</option>
                    <option value="Juni" {{ request('bulan_ps') === 'Juni' ? 'selected' : '' }}>Juni</option>
                    <option value="Juli" {{ request('bulan_ps') === 'Juli' ? 'selected' : '' }}>Juli</option>
                    <option value="Agustus" {{ request('bulan_ps') === 'Agustus' ? 'selected' : '' }}>Agustus</option>
                    <option value="September" {{ request('bulan_ps') === 'September' ? 'selected' : '' }}>September
                    </option>
                    <option value="Oktober" {{ request('bulan_ps') === 'Oktober' ? 'selected' : '' }}>Oktober</option>
                    <option value="November" {{ request('bulan_ps') === 'November' ? 'selected' : '' }}>November
                    </option>
                    <option value="Desember" {{ request('bulan_ps') === 'Desember' ? 'selected' : '' }}>Desember
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_mitra">ID Mitra:</label>
                <select name="id_mitra" id="id_mitra" class="form-control">
                    <option value="">-- Pilih ID Mitra --</option>
                    @foreach ($mitraList as $mitra)
                        <option value="{{ $mitra }}" {{ request('id_mitra') == $mitra ? 'selected' : '' }}>
                            {{ $mitra }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <canvas id="stoChart"></canvas>

        <script>
            var ctx = document.getElementById('stoChart').getContext('2d');
            var stoChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels), // gunakan $labels
                    datasets: [{
                        label: 'STO Data',
                        data: @json($data), // gunakan $data
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'STO'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw; // Show raw value
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</body>

</html>
