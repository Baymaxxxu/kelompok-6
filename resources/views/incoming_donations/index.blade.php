<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan Masuk - POSKO</title>

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
            margin-left: 20px;
            font-weight: bold;
            font-size: 15px;
        }

        .container {
            padding: 30px 40px;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #1e40af;
            color: white;
        }

        .btn-info {
            background: #0ea5e9;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
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

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        .action {
            display: flex;
            gap: 8px;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 25px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <h1>POSKO</h1>
            <span>Bantuan Masuk</span>
        </div>

        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('items.index') }}">Barang</a>
            <a href="{{ route('donors.index') }}">Donatur</a>
            <a href="{{ route('incoming-donations.index') }}">Bantuan Masuk</a>
        </div>
    </div>

    <div class="container">
        <div class="section">

            <div class="header">
                <h2>Data Bantuan Masuk</h2>
                <a href="{{ route('incoming-donations.create') }}" class="btn btn-primary">
                    + Input Bantuan Masuk
                </a>
            </div>

            @if (session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
                        <th width="210">Aksi</th>
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
                                    <span class="badge">
                                        {{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $donation->notes ?? '-' }}</td>
                            <td>
                                <div class="action">
                                    <a href="{{ route('incoming-donations.show', $donation->id) }}" class="btn btn-info">
                                        Detail
                                    </a>

                                    <form action="{{ route('incoming-donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data bantuan masuk ini? Stok barang akan dikurangi kembali.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada data bantuan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>