<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Bantuan - POSKO</title>

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
            margin-left: 24px;
            font-weight: bold;
            font-size: 16px;
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

        .btn-warning {
            background: #f59e0b;
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
            background: #dbeafe;
            color: #1e40af;
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
            <span>Barang Bantuan</span>
        </div>

        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('categories.index') }}">Kategori</a>
            <a href="{{ route('items.index') }}">Barang</a>
        </div>
    </div>

    <div class="container">
        <div class="section">

            <div class="header">
                <h2>Data Barang Bantuan</h2>
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    + Tambah Barang
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
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th width="180">Aksi</th>
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
                            <td>
                                <div class="action">
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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