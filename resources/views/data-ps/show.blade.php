<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PS Details</title>
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #a2c2e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #007bff, #36d1dc);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }

        .table {
            width: 100%;
            table-layout: fixed;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .split-table {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .table-container {
            flex: 1;
            min-width: 400px;
        }

        /* Word wrap for long text in table cells */
        .table td {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        /* Adjusting the width of specific columns */
        .table td:first-child {
            width: 30%;
            /* Adjust this based on your needs */
        }

        /* Adjust Kcontact specific row */
        .table td:last-child {
            max-width: 300px;
            /* Set a maximum width */
        }

        @media (max-width: 768px) {
            .split-table {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="{{ route('data-ps.index') }}" class="btn-back">Back</a>

        <div class="card">
            <div class="card-header">
                Data PS Details
            </div>
            <div class="card-body">
                <div class="split-table">
                    <!-- First half of the table -->
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>Order ID</td>
                                    <td>{{ $item['ORDER_ID'] }}</td>
                                </tr>
                                <tr>
                                    <td>Regional</td>
                                    <td>{{ $item['REGIONAL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Witel</td>
                                    <td>{{ $item['WITEL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Regional OLD</td>
                                    <td>{{ $item['REGIONAL_OLD'] }}</td>
                                </tr>
                                <tr>
                                    <td>Witel OLD</td>
                                    <td>{{ $item['WITEL_OLD'] }}</td>
                                </tr>
                                <tr>
                                    <td>Datel</td>
                                    <td>{{ $item['DATEL'] }}</td>
                                </tr>
                                <tr>
                                    <td>STO</td>
                                    <td>{{ $item['STO'] }}</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>{{ $item['UNIT'] }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis PSB</td>
                                    <td>{{ $item['JENISPSB'] }}</td>
                                </tr>
                                <tr>
                                    <td>Type Trans</td>
                                    <td>{{ $item['TYPE_TRANS'] }}</td>
                                </tr>
                                <tr>
                                    <td>Type Layanan</td>
                                    <td>{{ $item['TYPE_LAYANAN'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status Resume</td>
                                    <td>{{ $item['STATUS_RESUME'] }}</td>
                                </tr>
                                <tr>
                                    <td>Provider</td>
                                    <td>{{ $item['PROVIDER'] }}</td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td>{{ $item['ORDER_DATE'] }}</td>
                                </tr>
                                <tr>
                                    <td>Last Updated Date</td>
                                    <td>{{ $item['LAST_UPDATED_DATE'] }}</td>
                                </tr>
                                <tr>
                                    <td>NCLI</td>
                                    <td>{{ $item['NCLI'] }}</td>
                                </tr>
                                <tr>
                                    <td>POTS</td>
                                    <td>{{ $item['POTS'] }}</td>
                                </tr>
                                <tr>
                                    <td>Speedy</td>
                                    <td>{{ $item['SPEEDY'] }}</td>
                                </tr>
                                <tr>
                                    <td>Customer Name</td>
                                    <td>{{ $item['CUSTOMER_NAME'] }}</td>
                                </tr>
                                <tr>
                                    <td>LOC ID</td>
                                    <td>{{ $item['LOC_ID'] }}</td>
                                </tr>
                                <tr>
                                    <td>WONUM</td>
                                    <td>{{ $item['WONUM'] }}</td>
                                </tr>
                                <tr>
                                    <td>Flag Deposit</td>
                                    <td>{{ $item['FLAG_DEPOSIT'] }}</td>
                                </tr>
                                <tr>
                                    <td>Contact HP</td>
                                    <td>{{ $item['CONTACT_HP'] }}</td>
                                </tr>
                                <tr>
                                    <td>Install Address</td>
                                    <td>{{ $item['INS_ADDRESS'] }}</td>
                                </tr>
                                <tr>
                                    <td>GPS Longitude</td>
                                    <td>{{ $item['GPS_LONGITUDE'] }}</td>
                                </tr>
                                <tr>
                                    <td>GPS Latitude</td>
                                    <td>{{ $item['GPS_LATITUDE'] }}</td>
                                </tr>
                                <tr>
                                    <td>Kcontact</td>
                                    <td>{{ $item['KCONTACT'] }}</td>
                                </tr> <!-- Kcontact Row -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Second half of the table -->
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>Channel</td>
                                    <td>{{ $item['CHANNEL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status Inet</td>
                                    <td>{{ $item['STATUS_INET'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status ONU</td>
                                    <td>{{ $item['STATUS_ONU'] }}</td>
                                </tr>
                                <tr>
                                    <td>Upload</td>
                                    <td>{{ $item['UPLOAD'] }}</td>
                                </tr>
                                <tr>
                                    <td>Download</td>
                                    <td>{{ $item['DOWNLOAD'] }}</td>
                                </tr>
                                <tr>
                                    <td>Last Program</td>
                                    <td>{{ $item['LAST_PROGRAM'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status Voice</td>
                                    <td>{{ $item['STATUS_VOICE'] }}</td>
                                </tr>
                                <tr>
                                    <td>CLID</td>
                                    <td>{{ $item['CLID'] }}</td>
                                </tr>
                                <tr>
                                    <td>Last Start</td>
                                    <td>{{ $item['LAST_START'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tindak Lanjut</td>
                                    <td>{{ $item['TINDAK_LANJUT'] }}</td>
                                </tr>
                                <tr>
                                    <td>Isi Comment</td>
                                    <td>{{ $item['ISI_COMMENT'] }}</td>
                                </tr>
                                <tr>
                                    <td>User ID TL</td>
                                    <td>{{ $item['USER_ID_TL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Comment</td>
                                    <td>{{ $item['TGL_COMMENT'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Manja</td>
                                    <td>{{ $item['TANGGAL_MANJA'] }}</td>
                                </tr>
                                <tr>
                                    <td>Kelompok Kendala</td>
                                    <td>{{ $item['KELOMPOK_KENDALA'] }}</td>
                                </tr>
                                <tr>
                                    <td>Kelompok Status</td>
                                    <td>{{ $item['KELOMPOK_STATUS'] }}</td>
                                </tr>
                                <tr>
                                    <td>Hero</td>
                                    <td>{{ $item['HERO'] }}</td>
                                </tr>
                                <tr>
                                    <td>Add-on</td>
                                    <td>{{ $item['ADDON'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl PS</td>
                                    <td>{{ $item['TGL_PS'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status Message</td>
                                    <td>{{ $item['STATUS_MESSAGE'] }}</td>
                                </tr>
                                <tr>
                                    <td>Package Name</td>
                                    <td>{{ $item['PACKAGE_NAME'] }}</td>
                                </tr>
                                <tr>
                                    <td>Group Paket</td>
                                    <td>{{ $item['GROUP_PAKET'] }}</td>
                                </tr>
                                <tr>
                                    <td>Reason Cancel</td>
                                    <td>{{ $item['REASON_CANCEL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan Cancel</td>
                                    <td>{{ $item['KETERANGAN_CANCEL'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Manja</td>
                                    <td>{{ $item['TGL_MANJA'] }}</td>
                                </tr>
                                <tr>
                                    <td>Detail Manja</td>
                                    <td>{{ $item['DETAIL_MANJA'] }}</td>
                                </tr>
                                <tr>
                                    <td>Bulan PS</td>
                                    <td>{{ $item['Bulan_PS'] }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Sales</td>
                                    <td>{{ $item['Kode_sales'] }}</td>
                                </tr>
                                <tr>
                                    <td>Nama_SA</td>
                                    <td>{{ $item['Nama_SA'] }}</td>
                                </tr>
                                <tr>
                                    <td>Mitra</td>
                                    <td>{{ $item['Mitra'] }}</td>
                                </tr>
                                <tr>
                                    <td>Ekosistem</td>
                                    <td>{{ $item['Ekosistem'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
