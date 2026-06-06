<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Laporan POSKO</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 28px;
        }

        .navbar span {
            display: block;
            margin-top: 4px;
            font-size: 16px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
            font-weight: bold;
            font-size: 15px;
        }

        .container {
            padding: 30px 40px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .card h3 {
            margin: 0 0 12px 0;
            font-size: 15px;
            color: #6b7280;
            font-weight: normal;
        }

        .card .number {
            font-size: 32px;
            font-weight: bold;
            color: #1e40af;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .section h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .print-btn {
            background: #1e40af;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
            vertical-align: top;
        }

        .badge-blue {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1e40af;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-green {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-red {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 25px;
        }

        @media print {
            .navbar,
            .print-btn {
                display: none;
            }

            body {
                background: white;
            }

            .container {
                padding: 0;
            }

            .section,
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                display: block;
            }

            .navbar a {
                display: inline-block;
                margin-top: 10px;
                margin-left: 0;
                margin-right: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <h1>POSKO</h1>
            <span>Laporan Stok dan Riwayat Bantuan</span>
        </div>

        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('items.index') }}">Barang</a>
            <a href="{{ route('incoming-donations.index') }}">Bantuan Masuk</a>
            <a href="{{ route('outgoing-distributions.index') }}">Distribusi</a>
            <a href="{{ route('reports.index') }}">Laporan</a>
        </div>
    </div>

    <div class="container">

        <div class="section-title">
            <h1>Laporan POSKO</h1>
            <button onclick="window.print()" class="print-btn">Cetak Laporan</button>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Stok Tersedia</h3>
                <div class="number">{{ $totalStock }}</div>
            </div>

            <div class="card">
                <h3>Total Bantuan Masuk</h3>
                <div class="number">{{ $totalIncoming }}</div>
            </div>

            <div class="card">
                <h3>Total Bantuan Keluar</h3>
                <div class="number">{{ $totalOutgoing }}</div>
            </div>
        </div>

        <div class="section">
            <h2>Laporan Stok Barang</h2>

            <table>
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok Tersedia</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="badge-blue">
                                    {{ $item->category->name ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $item->unit }}</td>
                            <td>
                                <strong>{{ $item->stock }}</strong>
                            </td>
                            <td>{{ $item->description ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Riwayat Bantuan Masuk</h2>

            <table>
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incomingDonations as $donation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($donation->donation_date)->format('d-m-Y') }}</td>
                            <td>{{ $donation->donor->name ?? '-' }}</td>
                            <td>
                                @foreach ($donation->details as $detail)
                                    <div>{{ $detail->item->name ?? '-' }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($donation->details as $detail)
                                    <span class="badge-green">
                                        +{{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $donation->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada riwayat bantuan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Riwayat Bantuan Keluar / Distribusi</h2>

            <table>
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Tanggal</th>
                        <th>Penerima / Lokasi</th>
                        <th>Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($outgoingDistributions as $distribution)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($distribution->distribution_date)->format('d-m-Y') }}</td>
                            <td>{{ $distribution->recipient->name ?? '-' }}</td>
                            <td>
                                @foreach ($distribution->details as $detail)
                                    <div>{{ $detail->item->name ?? '-' }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($distribution->details as $detail)
                                    <span class="badge-red">
                                        -{{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $distribution->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada riwayat distribusi bantuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>