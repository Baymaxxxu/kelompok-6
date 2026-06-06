<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribusi Bantuan - POSKO</title>

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
            background: #fee2e2;
            color: #991b1b;
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
            <span>Bantuan Keluar / Distribusi</span>
        </div>

        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('items.index') }}">Barang</a>
            <a href="{{ route('recipients.index') }}">Penerima</a>
            <a href="{{ route('incoming-donations.index') }}">Bantuan Masuk</a>
            <a href="{{ route('outgoing-distributions.index') }}">Distribusi</a>
        </div>
    </div>

    <div class="container">
        <div class="section">

            <div class="header">
                <h2>Data Distribusi Bantuan</h2>
                <a href="{{ route('outgoing-distributions.create') }}" class="btn btn-primary">
                    + Input Distribusi
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
                        <th>Penerima / Lokasi</th>
                        <th>Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Catatan</th>
                        <th width="210">Aksi</th>
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
                                    <span class="badge">
                                        {{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $distribution->notes ?? '-' }}</td>
                            <td>
                                <div class="action">
                                    <a href="{{ route('outgoing-distributions.show', $distribution->id) }}" class="btn btn-info">
                                        Detail
                                    </a>

                                    <form action="{{ route('outgoing-distributions.destroy', $distribution->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data distribusi ini? Stok barang akan dikembalikan.')">
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
                                Belum ada data distribusi bantuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>