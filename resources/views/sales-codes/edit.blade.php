<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sales Code</title>
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
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            font-weight: 500;
            color: #555;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #004085;
            border-color: #004085;
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
        <div class="form-container">
            <h1>Edit Sales Code</h1>
            <form action="{{ route('sales-codes.update', $salesCode->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="mitra_nama">Mitra Nama</label>
                    <input type="text" class="form-control" name="mitra_nama" value="{{ $salesCode->mitra_nama }}" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $salesCode->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="sto">STO</label>
                    <input type="text" class="form-control" name="sto" value="{{ $salesCode->sto }}" required>
                </div>
                <div class="form-group">
                    <label for="id_mitra">ID Mitra</label>
                    <input type="text" class="form-control" name="id_mitra" value="{{ $salesCode->id_mitra }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" class="form-control" name="nama_mitra" value="{{ $salesCode->nama_mitra }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" name="role" value="{{ $salesCode->role }}" required>
                </div>
                <div class="form-group">
                    <label for="kode_agen">Kode Agen</label>
                    <input type="text" class="form-control" name="kode_agen" value="{{ $salesCode->kode_agen }}" required>
                </div>
                <div class="form-group">
                    <label for="kode_baru">Kode Baru</label>
                    <input type="text" class="form-control" name="kode_baru" value="{{ $salesCode->kode_baru }}" required>
                </div>
                <div class="form-group">
                    <label for="no_telp_valid">No Telp Valid</label>
                    <input type="text" class="form-control" name="no_telp_valid" value="{{ $salesCode->no_telp_valid }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_sa_2">Nama SA 2</label>
                    <input type="text" class="form-control" name="nama_sa_2" value="{{ $salesCode->nama_sa_2 }}" required>
                </div>
                <div class="form-group">
                    <label for="status_wpi">Status WPI</label>
                    <input type="text" class="form-control" name="status_wpi" value="{{ $salesCode->status_wpi }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
                <a href="{{ route('sales-codes.index') }}" class="btn btn-secondary mt-3">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
