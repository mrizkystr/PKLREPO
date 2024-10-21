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

        .main-content {
            margin-left: 250px;
            padding: 20px;
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

        tbody tr:hover {
            background-color: #e1f5fe;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
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

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Analysis PS by Day</h1>

        <!-- Month Filter Dropdown -->
        <form method="GET" action="{{ route('data-ps.day-analysis') }}" id="monthFilterForm">
            <div class="form-group">
                <label for="bulan_ps">Filter by Month</label>
                <select name="bulan_ps" id="bulan_ps" class="form-control"
                    onchange="document.getElementById('monthFilterForm').submit();">
                    <option value="">Select Month</option>
                    @foreach ($availableMonths as $month)
                        <option value="{{ $month }}" @if ($bulan_ps == $month) selected @endif>
                            {{ $month }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Display Analysis Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal PS</th>
                        <th>Detail</th>
                        <th>Total PS</th> <!-- Total PS dipindahkan ke sebelah kanan Detail -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dayAnalysis as $analysis)
                        <tr>
                            <td>{{ $analysis->tanggal }}</td>
                            <td>
                                <button class="btn btn-primary show-details" data-tanggal="{{ $analysis->tanggal }}">
                                    Show Details
                                </button>
                            </td>
                            <td>{{ $analysis->totalPS }}</td> <!-- Total PS ditampilkan di kolom kanan -->
                        </tr>
                        <tr id="details-{{ $analysis->tanggal }}" style="display: none;">
                            <td colspan="3">
                                <div class="details-container"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script for handling show-details and AJAX request remains unchanged -->
    <script>
        $(document).ready(function() {
            $('.show-details').on('click', function() {
                const tanggal = $(this).data('tanggal');
                const detailsRow = $('#details-' + tanggal);
                const container = detailsRow.find('.details-container');

                if (detailsRow.is(':visible')) {
                    detailsRow.hide();
                    container.empty();
                } else {
                    $.ajax({
                        url: "{{ route('data-ps.day-analysis') }}",
                        type: 'GET',
                        data: {
                            tanggal: tanggal
                        },
                        success: function(response) {
                            let detailHtml = '<table class="table table-sm"><thead><tr>' +
                                '<th>ORDER ID</th><th>STO</th><th>CUSTOMER NAME</th><th>ADDON</th><th>Kode Sales</th><th>Nama SA</th>' +
                                '</tr></thead><tbody>';

                            response.details.forEach(function(item) {
                                detailHtml += '<tr>' +
                                    '<td>' + item.ORDER_ID + '</td>' +
                                    '<td>' + item.STO + '</td>' +
                                    '<td>' + item.CUSTOMER_NAME + '</td>' +
                                    '<td>' + item.ADDON + '</td>' +
                                    '<td>' + item.Kode_sales + '</td>' +
                                    '<td>' + item.Nama_SA + '</td>' +
                                    '</tr>';
                            });

                            detailHtml += '</tbody></table>';
                            container.html(detailHtml);
                            detailsRow.show();
                        },
                        error: function() {
                            alert('Gagal mendapatkan data.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
