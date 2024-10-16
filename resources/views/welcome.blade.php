<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data PS Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" height="40" class="me-2">
                <span class="brand-text">Telkom Indonesia</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data-ps.sto-chart') }}">Bar Chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data-ps.mitra-pie-chart') }}">Pie Chart</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PS Overview
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('data-ps.sto-analysis') }}">PS Analysis by STO</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.code-analysis') }}">PS Analysis by Code</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.month-analysis') }}">PS Analysis by Month</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.mitra-analysis') }}">PS Analysis by ID Mitra</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-ps.day-analysis') }}">PS Data Analysis by Day</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="/logout" class="btn btn-danger ms-2">LOGIN</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center mt-5">
        <h1 class="display-4">DATA PS MANAGEMENT</h1>
        <img src="{{ asset('images/space-image.jpg') }}" alt="Space Image" class="img-fluid rounded-circle mb-4" style="max-width: 60%;">

        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales Codes</h5>
                        <p class="card-text">Graph of total sales codes over time.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">Graph of total orders over time.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Completed Orders</h5>
                        <p class="card-text">Graph of completed orders over time.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending Orders</h5>
                        <p class="card-text">Graph of pending orders over time.</p>
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
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
