<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSKO - Dashboard Bantuan Bencana</title>

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
            font-size: 24px;
        }

        .navbar span {
            font-size: 14px;
            opacity: 0.9;
        }

        .container {
            padding: 30px 40px;
        }

        .hero {
            background: white;
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .hero h2 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 28px;
            color: #111827;
        }

        .hero p {
            margin: 0;
            color: #6b7280;
            line-height: 1.6;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .card h3 {
            margin: 0 0 12px 0;
            font-size: 14px;
            color: #6b7280;
            font-weight: normal;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
            color: #1e40af;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .section h3 {
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 20px;
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
        }

        table th {
            color: #374151;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1e40af;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 30px;
        }

        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar,
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 600px) {
            .cards {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            .hero h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <h1>POSKO</h1>
            <span>Sistem Informasi Pendataan dan Penyaluran Bantuan Bencana</span>
        </div>
        <div>
            Dashboard
        </div>
    </div>

    <div class="container">

        <div class="hero">
            <h2>Dashboard Bantuan Bencana</h2>
            <p>
                POSKO digunakan untuk mencatat bantuan masuk, mengelola stok bantuan,
                dan memantau bantuan keluar atau distribusi ke korban maupun lokasi terdampak.
            </p>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Kategori</h3>
                <div class="number">{{ $totalCategories }}</div>
            </div>

            <div class="card">
                <h3>Total Barang</h3>
                <div class="number">{{ $totalItems }}</div>
            </div>

            <div class="card">
                <h3>Stok Tersedia</h3>
                <div class="number">{{ $totalStock }}</div>
            </div>

            <div class="card">
                <h3>Bantuan Masuk</h3>
                <div class="number">{{ $totalIncoming }}</div>
            </div>

            <div class="card">
                <h3>Bantuan Keluar</h3>
                <div class="number">{{ $totalOutgoing }}</div>
            </div>
        </div>

        <div class="section">
            <h3>Daftar Stok Barang Bantuan</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="badge">
                                    {{ $item->category->name ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->description ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data barang bantuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>