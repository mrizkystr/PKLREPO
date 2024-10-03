<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Sales Code</title>
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
            <h1>Create New Sales Code</h1>
            <form action="{{ route('sales-codes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="mitra_nama">Mitra Nama</label>
                    <input type="text" class="form-control" name="mitra_nama" id="mitra_nama" value="{{ old('mitra_nama') }}">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label for="sto">STO</label>
                    <input type="text" class="form-control" name="sto" id="sto" value="{{ old('sto') }}">
                </div>
                <div class="form-group">
                    <label for="id_mitra">ID Mitra</label>
                    <input type="text" class="form-control" name="id_mitra" id="id_mitra" value="{{ old('id_mitra') }}">
                </div>
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" class="form-control" name="nama_mitra" id="nama_mitra" value="{{ old('nama_mitra') }}">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" name="role" id="role" value="{{ old('role') }}">
                </div>
                <div class="form-group">
                    <label for="kode_agen">Kode Agen</label>
                    <input type="text" class="form-control" name="kode_agen" id="kode_agen" value="{{ old('kode_agen') }}">
                </div>
                <div class="form-group">
                    <label for="kode_baru">Kode Baru</label>
                    <input type="text" class="form-control" name="kode_baru" id="kode_baru" value="{{ old('kode_baru') }}">
                </div>
                <div class="form-group">
                    <label for="no_telp_valid">No Telp Valid</label>
                    <input type="text" class="form-control" name="no_telp_valid" id="no_telp_valid" value="{{ old('no_telp_valid') }}">
                </div>
                <div class="form-group">
                    <label for="nama_sa_2">Nama SA 2</label>
                    <input type="text" class="form-control" name="nama_sa_2" id="nama_sa_2" value="{{ old('nama_sa_2') }}">
                </div>
                <div class="form-group">
                    <label for="status_wpi">Status WPI</label>
                    <input type="text" class="form-control" name="status_wpi" id="status_wpi" value="{{ old('status_wpi') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{ route('sales-codes.index') }}" class="btn btn-secondary mt-3">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
