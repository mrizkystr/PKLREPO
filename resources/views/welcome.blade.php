<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data PS Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #666;
        }

        .social-icons img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/telkom.png') }}" alt="Logo" width="100" height="50" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria -expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data-ps.index') }}">Data PS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sales-codes.index') }}">Sales Codes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            STO Chart
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('data-ps.sto-chart') }}">STO Chart</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.sto-pie-chart') }}">STO Pie Chart</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Mitra Chart
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item" href="{{ route('data-ps.mitra-bar-chart') }}">Mitra
                                    Chart</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.mitra-pie-chart') }}">Mitra Pie
                                    Chart</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            PS Overview
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('data-ps.sto-analysis') }}">PS Analysis by
                                    STO</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.code-analysis') }}">PS Analysis by
                                    Code</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.month-analysis') }}">PS Analysis by
                                    Month</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.mitra-analysis') }}">PS Analysis by ID
                                    Mitra</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.day-analysis') }}">PS Data Analysis by
                                    Day</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('data-ps.target-tracking-and-sales-chart') }}">Trend
                            Sales</a>
                    </li>
                </ul>
                <a href="/logout" class="btn btn-danger ms-2">LOGIN</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center mt-5">
        <h1 class="display-4">DATA PS MANAGEMENT</h1>
        <img src="{{ asset('images/satelit.jpg') }}" alt="Satellite Image" class="img-fluid mb-4"
            style="max-width: 60%;">

            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales Codes</h5>
                            <p class="card-text">{{ $totalSalesCodes }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Completed Orders</h5>
                            <p class="card-text">{{ $completedOrders }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text">{{ $pendingOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center">
            <p>FOLLOW</p>
            <div class="social-icons d-flex justify-content-center">
                <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="mx-2">
                <img src="{{ asset('images/twitter.png') }}" alt="Twitter" class="mx-2">
                <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="mx-2">
                <img src="{{ asset('images/phone.png') }}" alt="Phone" class="mx-2">
            </div>
            <img src="{{ asset('images/tiang.png') }}" alt="Tiang" class="img -fluid mt-4"
                style="max-width: 30%; position: absolute; bottom: 20px; right: 0px;">
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
