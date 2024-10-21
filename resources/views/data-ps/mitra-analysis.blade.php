<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PS Analysis by Mitra</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        /* Global Body Styling */
        body {
            background: linear-gradient(135deg, #f3f4f6, #a2c2e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .table-container {
            background: linear-gradient(135deg, #5b86e5, #36d1dc);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
        }

        .table {
            width: 100%;
            background-color: white;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 15px;
        }

        thead th {
            background-color: #007bff !important;
            color: white !important;
            padding: 15px !important;
            text-align: center !important;
            font-size: 1.1em !important;
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

        .main-content {
            margin-left: 270px;
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
        <div class="container">
            <h1>Data Analysis PS by Mitra</h1>
            <form action="{{ route('data-ps.mitra-analysis') }}" method="GET">
                <div class="form-group">
                    <label for="sto">Pilih STO:</label>
                    <select name="sto" id="sto" class="form-control">
                        <option value="">Semua STO</option>
                        @foreach ($stoList as $sto)
                            <option value="{{ $sto }}" {{ $selectedSto === $sto ? 'selected' : '' }}>
                                {{ $sto }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="form-group">
                <label for="bulan_ps">Pilih Bulan:</label>
                <select name="bulan_ps" id="bulan_ps" class="form-control">
                    <option value="">Semua Bulan</option>
                    <option value="Januari" {{ $bulanPs === 'Januari' ? 'selected' : '' }}>Januari</option>
                    <option value="Februari" {{ $bulanPs === 'Februari' ? 'selected' : '' }}>Februari</option>
                    <option value="Maret" {{ $bulanPs === 'Maret' ? 'selected' : '' }}>Maret</option>
                    <option value="April" {{ $bulanPs === 'April' ? 'selected' : '' }}>April</option>
                    <option value="Mei" {{ $bulanPs === 'Mei' ? 'selected' : '' }}>Mei</option>
                    <option value="Juni" {{ $bulanPs === 'Juni' ? 'selected' : '' }}>Juni</option>
                    <option value="Juli" {{ $bulanPs === 'Juli' ? 'selected' : '' }}>Juli</option>
                    <option value="Agustus" {{ $bulanPs === 'Agustus' ? 'selected' : '' }}>Agustus</option>
                    <option value="September" {{ $bulanPs === 'September' ? 'selected' : '' }}>September</option>
                    <option value="Oktober" {{ $bulanPs === 'Oktober' ? 'selected' : '' }}>Oktober</option>
                    <option value="November" {{ $bulanPs === 'November' ? 'selected' : '' }}>November</option>
                    <option value="Desember" {{ $bulanPs === 'Desember' ? 'selected' : '' }}>Desember</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-container">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Mitra</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($mitraAnalysis->isEmpty())
                            <tr>
                                <td colspan="2">Tidak ada data untuk bulan {{ $bulanPs }} dan Mitra
                                    {{ $selectedMitra }}</td>
                            </tr>
                        @else
                            @foreach ($mitraAnalysis as $data)
                                <tr>
                                    <td>{{ $data->Mitra }}</td>
                                    <td>{{ $data->total }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
