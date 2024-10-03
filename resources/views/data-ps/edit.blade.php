<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data PS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-back {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            transition: background-color 0.3s ease;
            margin-bottom: 15px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Back Button -->
        <a href="{{ route('data-ps.index') }}" class="btn btn-back">Back</a>

        <h1>Edit Data PS</h1>

        <div class="form-container">
            <form action="{{ route('data-ps.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- ORDER_ID -->
                <!-- ORDER_ID (Read-Only) -->
                <div class="form-group">
                    <label for="ORDER_ID">Order ID</label>
                    <input type="text" class="form-control" name="ORDER_ID" value="{{ $item->ORDER_ID }}" readonly>
                </div>


                <!-- REGIONAL -->
                <div class="form-group">
                    <label for="REGIONAL">Regional</label>
                    <input type="number" class="form-control" name="REGIONAL" value="{{ $item->REGIONAL }}" required>
                </div>

                <!-- WITEL -->
                <div class="form-group">
                    <label for="WITEL">Witel</label>
                    <input type="text" class="form-control" name="WITEL" value="{{ $item->WITEL }}" required
                        maxlength="100">
                </div>

                <!-- DATEL -->
                <div class="form-group">
                    <label for="DATEL">Datel</label>
                    <input type="text" class="form-control" name="DATEL" value="{{ $item->DATEL }}" required
                        maxlength="100">
                </div>

                <!-- STO -->
                <div class="form-group">
                    <label for="STO">STO</label>
                    <input type="text" class="form-control" name="STO" value="{{ $item->STO }}" required
                        maxlength="10">
                </div>

                <!-- UNIT -->
                <div class="form-group">
                    <label for="UNIT">Unit</label>
                    <input type="text" class="form-control" name="UNIT" value="{{ $item->UNIT }}"
                        maxlength="10">
                </div>

                <!-- JENISPSB -->
                <div class="form-group">
                    <label for="JENISPSB">Jenis PSB</label>
                    <input type="text" class="form-control" name="JENISPSB" value="{{ $item->JENISPSB }}"
                        maxlength="50">
                </div>

                <!-- TYPE_TRANS -->
                <div class="form-group">
                    <label for="TYPE_TRANS">Type Trans</label>
                    <input type="text" class="form-control" name="TYPE_TRANS" value="{{ $item->TYPE_TRANS }}"
                        maxlength="50">
                </div>

                <!-- TYPE_LAYANAN -->
                <div class="form-group">
                    <label for="TYPE_LAYANAN">Type Layanan</label>
                    <input type="text" class="form-control" name="TYPE_LAYANAN" value="{{ $item->TYPE_LAYANAN }}"
                        maxlength="50">
                </div>

                <!-- STATUS_RESUME -->
                <div class="form-group">
                    <label for="STATUS_RESUME">Status Resume</label>
                    <input type="text" class="form-control" name="STATUS_RESUME" value="{{ $item->STATUS_RESUME }}"
                        maxlength="255">
                </div>

                <!-- PROVIDER -->
                <div class="form-group">
                    <label for="PROVIDER">Provider</label>
                    <input type="text" class="form-control" name="PROVIDER" value="{{ $item->PROVIDER }}"
                        maxlength="100">
                </div>

                <!-- ORDER_DATE -->
                <div class="form-group">
                    <label for="ORDER_DATE">Order Date</label>
                    <input type="datetime-local" class="form-control" name="ORDER_DATE"
                        value="{{ $item->ORDER_DATE ? \Carbon\Carbon::parse($item->ORDER_DATE)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- LAST_UPDATED_DATE -->
                <div class="form-group">
                    <label for="LAST_UPDATED_DATE">Last Updated Date</label>
                    <input type="datetime-local" class="form-control" name="LAST_UPDATED_DATE"
                        value="{{ $item->LAST_UPDATED_DATE ? \Carbon\Carbon::parse($item->LAST_UPDATED_DATE)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- NCLI -->
                <div class="form-group">
                    <label for="NCLI">NCLI</label>
                    <input type="number" class="form-control" name="NCLI" value="{{ $item->NCLI }}">
                </div>

                <!-- POTS -->
                <div class="form-group">
                    <label for="POTS">POTS</label>
                    <input type="text" class="form-control" name="POTS" value="{{ $item->POTS }}"
                        maxlength="50">
                </div>

                <!-- SPEEDY -->
                <div class="form-group">
                    <label for="SPEEDY">Speedy</label>
                    <input type="text" class="form-control" name="SPEEDY" value="{{ $item->SPEEDY }}"
                        maxlength="50">
                </div>

                <!-- CUSTOMER_NAME -->
                <div class="form-group">
                    <label for="CUSTOMER_NAME">Customer Name</label>
                    <input type="text" class="form-control" name="CUSTOMER_NAME"
                        value="{{ $item->CUSTOMER_NAME }}" maxlength="255">
                </div>

                <!-- LOC_ID -->
                <div class="form-group">
                    <label for="LOC_ID">LOC ID</label>
                    <input type="text" class="form-control" name="LOC_ID" value="{{ $item->LOC_ID }}"
                        maxlength="50">
                </div>

                <!-- WONUM -->
                <div class="form-group">
                    <label for="WONUM">WONUM</label>
                    <input type="text" class="form-control" name="WONUM" value="{{ $item->WONUM }}"
                        maxlength="50">
                </div>

                <!-- FLAG_DEPOSIT -->
                <div class="form-group">
                    <label for="FLAG_DEPOSIT">Flag Deposit</label>
                    <input type="text" class="form-control" name="FLAG_DEPOSIT"
                        value="{{ $item->FLAG_DEPOSIT }}" maxlength="10">
                </div>

                <!-- CONTACT_HP -->
                <div class="form-group">
                    <label for="CONTACT_HP">Contact HP</label>
                    <input type="text" class="form-control" name="CONTACT_HP" value="{{ $item->CONTACT_HP }}"
                        maxlength="20">
                </div>

                <!-- INS_ADDRESS -->
                <div class="form-group">
                    <label for="INS_ADDRESS">Ins Address</label>
                    <textarea class="form-control" name="INS_ADDRESS">{{ $item->INS_ADDRESS }}</textarea>
                </div>

                <!-- GPS_LONGITUDE -->
                <div class="form-group">
                    <label for="GPS_LONGITUDE">GPS Longitude</label>
                    <input type="text" class="form-control" name="GPS_LONGITUDE"
                        value="{{ $item->GPS_LONGITUDE }}" maxlength="50">
                </div>

                <!-- GPS_LATITUDE -->
                <div class="form-group">
                    <label for="GPS_LATITUDE">GPS Latitude</label>
                    <input type="text" class="form-control" name="GPS_LATITUDE"
                        value="{{ $item->GPS_LATITUDE }}" maxlength="50">
                </div>

                <!-- KCONTACT -->
                <div class="form-group">
                    <label for="KCONTACT">KContact</label>
                    <textarea class="form-control" name="KCONTACT">{{ $item->KCONTACT }}</textarea>
                </div>

                <!-- CHANNEL -->
                <div class="form-group">
                    <label for="CHANNEL">Channel</label>
                    <input type="text" class="form-control" name="CHANNEL" value="{{ $item->CHANNEL }}"
                        maxlength="100">
                </div>

                <!-- STATUS_INET -->
                <div class="form-group">
                    <label for="STATUS_INET">Status INET</label>
                    <input type="text" class="form-control" name="STATUS_INET" value="{{ $item->STATUS_INET }}"
                        maxlength="50">
                </div>

                <!-- STATUS_ONU -->
                <div class="form-group">
                    <label for="STATUS_ONU">Status ONU</label>
                    <input type="text" class="form-control" name="STATUS_ONU" value="{{ $item->STATUS_ONU }}"
                        maxlength="50">
                </div>

                <!-- UPLOAD -->
                <div class="form-group">
                    <label for="UPLOAD">Upload</label>
                    <input type="text" class="form-control" name="UPLOAD" value="{{ $item->UPLOAD }}"
                        maxlength="50">
                </div>

                <!-- DOWNLOAD -->
                <div class="form-group">
                    <label for="DOWNLOAD">Download</label>
                    <input type="text" class="form-control" name="DOWNLOAD" value="{{ $item->DOWNLOAD }}"
                        maxlength="50">
                </div>

                <!-- LAST_PROGRAM -->
                <div class="form-group">
                    <label for="LAST_PROGRAM">Last Program</label>
                    <input type="text" class="form-control" name="LAST_PROGRAM"
                        value="{{ $item->LAST_PROGRAM }}" maxlength="100">
                </div>

                <!-- STATUS_VOICE -->
                <div class="form-group">
                    <label for="STATUS_VOICE">Status Voice</label>
                    <input type="text" class="form-control" name="STATUS_VOICE"
                        value="{{ $item->STATUS_VOICE }}" maxlength="50">
                </div>

                <!-- CLID -->
                <div class="form-group">
                    <label for="CLID">CLID</label>
                    <input type="text" class="form-control" name="CLID" value="{{ $item->CLID }}"
                        maxlength="500">
                </div>

                <!-- LAST_START -->
                <div class="form-group">
                    <label for="LAST_START">Last Start</label>
                    <input type="datetime-local" class="form-control" name="LAST_START"
                        value="{{ $item->LAST_START ? \Carbon\Carbon::parse($item->LAST_START)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- TINDAK_LANJUT -->
                <div class="form-group">
                    <label for="TINDAK_LANJUT">Tindak Lanjut</label>
                    <textarea class="form-control" name="TINDAK_LANJUT">{{ $item->TINDAK_LANJUT }}</textarea>
                </div>

                <!-- ISI_COMMENT -->
                <div class="form-group">
                    <label for="ISI_COMMENT">Isi Comment</label>
                    <textarea class="form-control" name="ISI_COMMENT">{{ $item->ISI_COMMENT }}</textarea>
                </div>

                <!-- USER_ID_TL -->
                <div class="form-group">
                    <label for="USER_ID_TL">User ID TL</label>
                    <input type="text" class="form-control" name="USER_ID_TL" value="{{ $item->USER_ID_TL }}"
                        maxlength="50">
                </div>

                <!-- TGL_COMMENT -->
                <div class="form-group">
                    <label for="TGL_COMMENT">Tanggal Comment</label>
                    <input type="datetime-local" class="form-control" name="TGL_COMMENT"
                        value="{{ $item->TGL_COMMENT ? \Carbon\Carbon::parse($item->TGL_COMMENT)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- TANGGAL_MANJA -->
                <div class="form-group">
                    <label for="TANGGAL_MANJA">Tanggal Manja</label>
                    <input type="datetime-local" class="form-control" name="TANGGAL_MANJA"
                        value="{{ $item->TANGGAL_MANJA ? \Carbon\Carbon::parse($item->TANGGAL_MANJA)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- KELOMPOK_KENDALA -->
                <div class="form-group">
                    <label for="KELOMPOK_KENDALA">Kelompok Kendala</label>
                    <input type="text" class="form-control" name="KELOMPOK_KENDALA"
                        value="{{ $item->KELOMPOK_KENDALA }}" maxlength="100">
                </div>

                <!-- KELOMPOK_STATUS -->
                <div class="form-group">
                    <label for="KELOMPOK_STATUS">Kelompok Status</label>
                    <input type="text" class="form-control" name="KELOMPOK_STATUS"
                        value="{{ $item->KELOMPOK_STATUS }}" maxlength="100">
                </div>

                <!-- HERO -->
                <div class="form-group">
                    <label for="HERO">Hero</label>
                    <input type="text" class="form-control" name="HERO" value="{{ $item->HERO }}"
                        maxlength="50">
                </div>

                <!-- ADDON -->
                <div class="form-group">
                    <label for="ADDON">Addon</label>
                    <input type="text" class="form-control" name="ADDON" value="{{ $item->ADDON }}"
                        maxlength="50">
                </div>

                <!-- TGL_PS -->
                <div class="form-group">
                    <label for="TGL_PS">Tanggal PS</label>
                    <input type="datetime-local" class="form-control" name="TGL_PS"
                        value="{{ $item->TGL_PS ? \Carbon\Carbon::parse($item->TGL_PS)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <!-- STATUS_MESSAGE -->
                <div class="form-group">
                    <label for="STATUS_MESSAGE">Status Message</label>
                    <input type="text" class="form-control" name="STATUS_MESSAGE"
                        value="{{ $item->STATUS_MESSAGE }}" maxlength="50">
                </div>

                <!-- PACKAGE_NAME -->
                <div class="form-group">
                    <label for="PACKAGE_NAME">Package Name</label>
                    <input type="text" class="form-control" name="PACKAGE_NAME"
                        value="{{ $item->PACKAGE_NAME }}" maxlength="100">
                </div>

                <!-- GROUP_PAKET -->
                <div class="form-group">
                    <label for="GROUP_PAKET">GROUP  PAKET</label>
                    <input type="text" class="form-control" name="GROUP_PAKET" value="{{ $item->GROUP_PAKET }}"
                        maxlength="100">
                </div>

                <!-- HARGA_PAKET (PACKAGE PRICE) -->
                <div class="form-group">
                    <label for="HARGA_PAKET">HARGA PAKET</label>
                    <input type="text" class="form-control" name="HARGA_PAKET" id="HARGA_PAKET"
                        value="{{ old('HARGA_PAKET') }}">
                </div>

                <!-- KETERANGAN_CANCEL (CANCEL INFORMATION) -->
                <div class="form-group">
                    <label for="KETERANGAN_CANCEL">KETERANGAN CANCEL</label>
                    <input type="text" class="form-control" name="KETERANGAN_CANCEL" id="KETERANGAN_CANCEL"
                        value="{{ old('KETERANGAN_CANCEL') }}">
                </div>

                <!-- TGL_MANJA (MANJA DATE) -->
                <div class="form-group">
                    <label for="TGL_MANJA">TANGGAL MANJA</label>
                    <input type="date" class="form-control" name="TGL_MANJA" id="TGL_MANJA"
                        value="{{ old('TGL_MANJA') }}">
                </div>

                <!-- DETAIL_MANJA (MANJA DETAILS) -->
                <div class="form-group">
                    <label for="DETAIL_MANJA">DETAIL MANJA</label>
                    <input type="text" class="form-control" name="DETAIL_MANJA" id="DETAIL_MANJA"
                        value="{{ old('DETAIL_MANJA') }}">
                </div>

                <!-- Other fields follow with similar pattern... -->

                <!-- SAVE BUTTON -->
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>
</body>

</html>
