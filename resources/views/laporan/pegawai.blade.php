<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pegawai</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body { 
            font-family: sans-serif; 
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        p {
            font-size: 14px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p><strong>Tanggal Cetak:</strong> {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 50%;">Nama Pegawai</th>
                <th style="width: 40%;">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p['nama'] }}</td>
                <td>{{ $p['jabatan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>