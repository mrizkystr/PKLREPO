<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Code Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 30px;
        }
        .card p {
            font-size: 16px;
            color: #555;
        }
        .btn-secondary {
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Sales Code Details</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Mitra Nama:</strong> {{ $salesCode->mitra_nama }}</p>
                <p><strong>Nama:</strong> {{ $salesCode->nama }}</p>
                <p><strong>STO:</strong> {{ $salesCode->sto }}</p>
                <p><strong>ID Mitra:</strong> {{ $salesCode->id_mitra }}</p>
                <p><strong>Nama Mitra:</strong> {{ $salesCode->nama_mitra }}</p>
                <p><strong>Role:</strong> {{ $salesCode->role }}</p>
                <p><strong>Kode Agen:</strong> {{ $salesCode->kode_agen }}</p>
                <p><strong>Kode Baru:</strong> {{ $salesCode->kode_baru }}</p>
                <p><strong>No Telp Valid:</strong> {{ $salesCode->no_telp_valid }}</p>
                <p><strong>Nama Sa 2:</strong> {{ $salesCode->nama_sa_2 }}</p>
                <p><strong>Status WPI:</strong> {{ $salesCode->status_wpi }}</p>
            </div>
        </div>
        <a href="{{ route('sales-codes.index') }}" class="btn btn-secondary mt-4">Back</a>
    </div>
</body>
</html>
