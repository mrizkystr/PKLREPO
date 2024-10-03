<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analysis PS per Hari</title>

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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .table-container {
            background: linear-gradient(135deg, #5b86e5, #36d1dc);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 30px auto;
            width: 90%;
            display: flex;
            justify-content: center;
        }

        .table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-spacing: 0;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        thead th {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        tbody td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
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
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            margin-left: 10px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .main-content {
            margin-left: 250px;
            /* Adjust for sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
        <div class="container">
            <h1>Data Analysis PS per Hari</h1>
            <form action="{{ route('data-ps.day-analysis') }}" method="GET">
                <!-- Filter by Day -->
                <div class="form-group">
                    <label for="tanggal_ps">Pilih Tanggal:</label>
                    <input type="date" name="tanggal_ps" id="tanggal_ps" class="form-control"
                        value="{{ $tanggal_ps ?? '' }}">
                </div>

                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('data-ps.day-analysis') }}" class="btn btn-secondary">Lihat Semua Data</a>
            </form>

            <!-- Display Analysis Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal PS</th>
                                <th>STO</th>
                                <th>Nama SA</th>
                                <th>ORDER ID</th>
                                <th>ADDON</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dayAnalysis as $analysis)
                                <tr>
                                    <td>{{ $analysis->tanggal }}</td>
                                    <td>{{ $analysis->STO }}</td>
                                    <td>{{ $analysis->Nama_SA }}</td>
                                    <td>{{ $analysis->ORDER_ID }}</td>
                                    <td>{{ $analysis->ADDON }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Back to List Button -->
            <div class="text-center mt-4">
                <a href="{{ route('data-ps.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
