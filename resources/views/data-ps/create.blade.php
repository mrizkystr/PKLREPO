<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data PS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1><center>Create New Data PS</center></h1>

        <!-- Button Back -->
        <a href="{{ route('data-ps.index') }}" class="btn btn-secondary mb-3">Back</a>


        <form action="{{ route('data-ps.store') }}" method="POST">
            @csrf

            <form action="/submit" method="POST">
                <div class="form-group">
                    <label for="ORDER_ID">ORDER ID</label>
                    <input type="text" class="form-control" name="ORDER_ID" id="ORDER_ID"
                        value="{{ old('ORDER_ID') }}" required>
                </div>

                <div class="form-group">
                    <label for="REGIONAL">REGIONAL</label>
                    <input type="number" class="form-control" name="REGIONAL" id="REGIONAL"
                        value="{{ old('REGIONAL') }}" required>
                </div>

                <div class="form-group">
                    <label for="WITEL">WITEL</label>
                    <input type="text" class="form-control" name="WITEL" id="WITEL"
                        value="{{ old('WITEL') }}">
                </div>

                <div class="form-group">
                    <label for="DATEL">DATEL</label>
                    <input type="text" class="form-control" name="DATEL" id="DATEL"
                        value="{{ old('DATEL') }}">
                </div>

                <div class="form-group">
                    <label for="STO">STO</label>
                    <input type="text" class="form-control" name="STO" id="STO"
                        value="{{ old('STO') }}">
                </div>

                <div class="form-group">
                    <label for="UNIT">UNIT</label>
                    <input type="text" class="form-control" name="UNIT" id="UNIT"
                        value="{{ old('UNIT') }}">
                </div>

                <div class="form-group">
                    <label for="JENISPSB">JENIS PSB</label>
                    <input type="text" class="form-control" name="JENISPSB" id="JENISPSB"
                        value="{{ old('JENISPSB') }}">
                </div>

                <div class="form-group">
                    <label for="TYPE_TRANS">TYPE TRANS</label>
                    <input type="text" class="form-control" name="TYPE_TRANS" id="TYPE_TRANS"
                        value="{{ old('TYPE_TRANS') }}">
                </div>

                <div class="form-group">
                    <label for="TYPE_LAYANAN">TYPE LAYANAN</label>
                    <input type="text" class="form-control" name="TYPE_LAYANAN" id="TYPE_LAYANAN"
                        value="{{ old('TYPE_LAYANAN') }}">
                </div>

                <div class="form-group">
                    <label for="STATUS_RESUME">STATUS RESUME</label>
                    <input type="text" class="form-control" name="STATUS_RESUME" id="STATUS_RESUME"
                        value="{{ old('STATUS_RESUME') }}">
                </div>

                <div class="form-group">
                    <label for="PROVIDER">PROVIDER</label>
                    <input type="text" class="form-control" name="PROVIDER" id="PROVIDER"
                        value="{{ old('PROVIDER') }}">
                </div>

                <div class="form-group">
                    <label for="ORDER_DATE">ORDER DATE</label>
                    <input type="date" class="form-control" name="ORDER_DATE" id="ORDER_DATE"
                        value="{{ old('ORDER_DATE') }}">
                </div>

                <div class="form-group">
                    <label for="LAST_UPDATED_DATE">LAST UPDATED DATE</label>
                    <input type="date" class="form-control" name="LAST_UPDATED_DATE" id="LAST_UPDATED_DATE"
                        value="{{ old('LAST_UPDATED_DATE') }}">
                </div>

                <div class="form-group">
                    <label for="NCLI">NCLI</label>
                    <input type="number" class="form-control" name="NCLI" id="NCLI"
                        value="{{ old('NCLI') }}">
                </div>

                <div class="form-group">
                    <label for="POTS">POTS</label>
                    <input type="text" class="form-control" name="POTS" id="POTS"
                        value="{{ old('POTS') }}">
                </div>

                <div class="form-group">
                    <label for="SPEEDY">SPEEDY</label>
                    <input type="text" class="form-control" name="SPEEDY" id="SPEEDY"
                        value="{{ old('SPEEDY') }}">
                </div>

                <div class="form-group">
                    <label for="CUSTOMER_NAME">CUSTOMER NAME</label>
                    <input type="text" class="form-control" name="CUSTOMER_NAME" id="CUSTOMER_NAME"
                        value="{{ old('CUSTOMER_NAME') }}">
                </div>

                <div class="form-group">
                    <label for="LOC_ID">LOC ID</label>
                    <input type="text" class="form-control" name="LOC_ID" id="LOC_ID"
                        value="{{ old('LOC_ID') }}">
                </div>

                <div class="form-group">
                    <label for="WONUM">WONUM</label>
                    <input type="text" class="form-control" name="WONUM" id="WONUM"
                        value="{{ old('WONUM') }}">
                </div>

                <div class="form-group">
                    <label for="FLAG_DEPOSIT">FLAG DEPOSIT</label>
                    <input type="text" class="form-control" name="FLAG_DEPOSIT" id="FLAG_DEPOSIT"
                        value="{{ old('FLAG_DEPOSIT') }}">
                </div>

                <div class="form-group">
                    <label for="CONTACT_HP">CONTACT HP</label>
                    <input type="text" class="form-control" name="CONTACT_HP" id="CONTACT_HP"
                        value="{{ old('CONTACT_HP') }}">
                </div>

                <div class="form-group">
                    <label for="INS_ADDRESS">INSTALLATION ADDRESS</label>
                    <input type="text" class="form-control" name="INS_ADDRESS" id="INS_ADDRESS"
                        value="{{ old('INS_ADDRESS') }}">
                </div>

                <div class="form-group">
                    <label for="GPS_LONGITUDE">GPS LONGITUDE</label>
                    <input type="text" class="form-control" name="GPS_LONGITUDE" id="GPS_LONGITUDE"
                        value="{{ old('GPS_LONGITUDE') }}">
                </div>

                <div class="form-group">
                    <label for="GPS_LATITUDE">GPS LATITUDE</label>
                    <input type="text" class="form-control" name="GPS_LATITUDE" id="GPS_LATITUDE"
                        value="{{ old('GPS_LATITUDE') }}">
                </div>

                <div class="form-group">
                    <label for="KCONTACT">KCONTACT</label>
                    <input type="text" class="form-control" name="KCONTACT" id="KCONTACT"
                        value="{{ old('KCONTACT') }}">
                </div>

                <div class="form-group">
                    <label for="CHANNEL">CHANNEL</label>
                    <input type="text" class="form-control" name="CHANNEL" id="CHANNEL"
                        value="{{ old('CHANNEL') }}">
                </div>

                <div class="form-group">
                    <label for="STATUS_INET">STATUS INTERNET</label>
                    <input type="text" class="form-control" name="STATUS_INET" id="STATUS_INET"
                        value="{{ old('STATUS_INET') }}">
                </div>

                <div class="form-group">
                    <label for="STATUS_ONU">STATUS ONU</label>
                    <input type="text" class="form-control" name="STATUS_ONU" id="STATUS_ONU"
                        value="{{ old('STATUS_ONU') }}">
                </div>

                <div class="form-group">
                    <label for="UPLOAD">UPLOAD SPEED</label>
                    <input type="text" class="form-control" name="UPLOAD" id="UPLOAD"
                        value="{{ old('UPLOAD') }}">
                </div>

                <div class="form-group">
                    <label for="DOWNLOAD">DOWNLOAD SPEED</label>
                    <input type="text" class="form-control" name="DOWNLOAD" id="DOWNLOAD"
                        value="{{ old('DOWNLOAD') }}">
                </div>

                <div class="form-group">
                    <label for="LAST_PROGRAM">LAST PROGRAM</label>
                    <input type="text" class="form-control" name="LAST_PROGRAM" id="LAST_PROGRAM"
                        value="{{ old('LAST_PROGRAM') }}">
                </div>

                <div class="form-group">
                    <label for="STATUS_VOICE">STATUS VOICE</label>
                    <input type="text" class="form-control" name="STATUS_VOICE" id="STATUS_VOICE"
                        value="{{ old('STATUS_VOICE') }}">
                </div>

                <div class="form-group">
                    <label for="CLID">CLID</label>
                    <input type="text" class="form-control" name="CLID" id="CLID"
                        value="{{ old('CLID') }}">
                </div>

                <div class="form-group">
                    <label for="LAST_START">LAST START DATE</label>
                    <input type="date" class="form-control" name="LAST_START" id="LAST_START"
                        value="{{ old('LAST_START') }}">
                </div>

                <div class="form-group">
                    <label for="TINDAK_LANJUT">FOLLOW-UP ACTION</label>
                    <input type="text" class="form-control" name="TINDAK_LANJUT" id="TINDAK_LANJUT"
                        value="{{ old('TINDAK_LANJUT') }}">
                </div>

                <div class="form-group">
                    <label for="ISI_COMMENT">COMMENT</label>
                    <input type="text" class="form-control" name="ISI_COMMENT" id="ISI_COMMENT"
                        value="{{ old('ISI_COMMENT') }}">
                </div>

                <div class="form-group">
                    <label for="USER_ID_TL">USER ID TL</label>
                    <input type="text" class="form-control" name="USER_ID_TL" id="USER_ID_TL"
                        value="{{ old('USER_ID_TL') }}">
                </div>

                <div class="form-group">
                    <label for="TGL_COMMENT">COMMENT DATE</label>
                    <input type="date" class="form-control" name="TGL_COMMENT" id="TGL_COMMENT"
                        value="{{ old('TGL_COMMENT') }}">
                </div>

                <div class="form-group">
                    <label for="TANGGAL_MANJA">DATE OF MANJA</label>
                    <input type="date" class="form-control" name="TANGGAL_MANJA" id="TANGGAL_MANJA"
                        value="{{ old('TANGGAL_MANJA') }}">
                </div>

                <div class="form-group">
                    <label for="KELOMPOK_KENDALA">OBSTACLE GROUP</label>
                    <input type="text" class="form-control" name="KELOMPOK_KENDALA" id="KELOMPOK_KENDALA"
                        value="{{ old('KELOMPOK_KENDALA') }}">
                </div>

                <div class="form-group">
                    <label for="KELOMPOK_STATUS">STATUS GROUP</label>
                    <input type="text" class="form-control" name="KELOMPOK_STATUS" id="KELOMPOK_STATUS"
                        value="{{ old('KELOMPOK_STATUS') }}">
                </div>

                <div class="form-group">
                    <label for="HERO">HERO</label>
                    <input type="text" class="form-control" name="HERO" id="HERO"
                        value="{{ old('HERO') }}">
                </div>

                <div class="form-group">
                    <label for="ADDON">ADDON</label>
                    <input type="text" class="form-control" name="ADDON" id="ADDON"
                        value="{{ old('ADDON') }}">
                </div>

                <div class="form-group">
                    <label for="TGL_PS">DATE OF PS</label>
                    <input type="date" class="form-control" name="TGL_PS" id="TGL_PS"
                        value="{{ old('TGL_PS') }}">
                </div>

                <div class="form-group">
                    <label for="STATUS_MESSAGE">STATUS MESSAGE</label>
                    <input type="text" class="form-control" name="STATUS_MESSAGE" id="STATUS_MESSAGE"
                        value="{{ old('STATUS_MESSAGE') }}">
                </div>

                <div class="form-group">
                    <label for="PACKAGE_NAME">PACKAGE NAME</label>
                    <input type="text" class="form-control" name="PACKAGE_NAME" id="PACKAGE_NAME"
                        value="{{ old('PACKAGE_NAME') }}">
                </div>

                <div class="form-group">
                    <label for="GROUP_PAKET">PACKAGE GROUP</label>
                    <input type="text" class="form-control" name="GROUP_PAKET" id="GROUP_PAKET"
                        value="{{ old('GROUP_PAKET') }}">
                </div>

                <div class="form-group">
                    <label for="HARGA_PAKET">PACKAGE PRICE</label>
                    <input type="text" class="form-control" name="HARGA_PAKET" id="HARGA_PAKET"
                        value="{{ old('HARGA_PAKET') }}">
                </div>

                <div class="form-group">
                    <label for="KETERANGAN_CANCEL">CANCEL INFORMATION</label>
                    <input type="text" class="form-control" name="KETERANGAN_CANCEL" id="KETERANGAN_CANCEL"
                        value="{{ old('KETERANGAN_CANCEL') }}">
                </div>

                <div class="form-group">
                    <label for="TGL_MANJA">MANJA DATE</label>
                    <input type="date" class="form-control" name="TGL_MANJA" id="TGL_MANJA"
                        value="{{ old('TGL_MANJA') }}">
                </div>

                <div class="form-group">
                    <label for="DETAIL_MANJA">MANJA DETAILS</label>
                    <input type="text" class="form-control" name="DETAIL_MANJA" id="DETAIL_MANJA"
                        value="{{ old('DETAIL_MANJA') }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</body>

</html>
