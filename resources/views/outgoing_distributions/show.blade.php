<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Distribusi Bantuan - POSKO</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f8;
            color: #1f2937;
        }

        .navbar {
            background: #1e40af;
            color: white;
            padding: 18px 40px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 28px;
        }

        .container {
            padding: 30px 40px;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
            max-width: 850px;
        }

        .info-row {
            margin-bottom: 14px;
            font-size: 15px;
        }

        .info-row strong {
            display: inline-block;
            width: 180px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        table thead {
            background: #eff6ff;
        }

        table th,
        table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>POSKO</h1>
        <span>Detail Bantuan Keluar / Distribusi</span>
    </div>

    <div class="container">
        <div class="section">
            <h2>Detail Distribusi Bantuan</h2>

            <div class="info-row">
                <strong>Tanggal Distribusi</strong>
                : {{ \Carbon\Carbon::parse($outgoingDistribution->distribution_date)->format('d-m-Y') }}
            </div>

            <div class="info-row">
                <strong>Penerima / Tujuan</strong>
                : {{ $outgoingDistribution->recipient->name ?? '-' }}
            </div>

            <div class="info-row">
                <strong>Lokasi</strong>
                : {{ $outgoingDistribution->recipient->location ?? '-' }}
            </div>

            <div class="info-row">
                <strong>Catatan</strong>
                : {{ $outgoingDistribution->notes ?? '-' }}
            </div>

            <h3>Barang yang Disalurkan</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outgoingDistribution->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->item->name ?? '-' }}</td>
                            <td>{{ $detail->item->category->name ?? '-' }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->item->unit ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('outgoing-distributions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</body>
</html>