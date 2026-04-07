<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: middle; /* Agar foto berada di tengah vertikal */
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .foto-siswa {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%; /* Opsional: membuat foto bulat */
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Service</h2>
        <p>Aplikasi Kasir Laundry</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Nama Service</th>
                <th>Harga</th>
                <th>Satuan</th>

            </tr>
        </thead>
        <tbody>
            @foreach($services as $index => $service)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $service->nama_layanan }}</td>
                <td>{{ $service->harga }}</td>
                <td>{{ $service->satuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html