<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Distribusi Bantuan - POSKO</title>

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
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        textarea {
            height: 120px;
            resize: vertical;
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

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .info {
            background: #eff6ff;
            color: #1e40af;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .warning {
            background: #fef3c7;
            color: #92400e;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>POSKO</h1>
        <span>Input Bantuan Keluar / Distribusi</span>
    </div>

    <div class="container">
        <div class="section">
            <h2>Input Bantuan Keluar / Distribusi</h2>

            <div class="info">
                Data distribusi akan otomatis mengurangi stok barang bantuan.
            </div>

            <div class="warning">
                Jumlah keluar tidak boleh lebih besar dari stok yang tersedia.
            </div>

            <form action="{{ route('outgoing-distributions.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Penerima / Lokasi Tujuan</label>
                    <select name="recipient_id">
                        <option value="">-- Pilih Penerima --</option>
                        @foreach ($recipients as $recipient)
                            <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>
                                {{ $recipient->name }}
                                @if ($recipient->location)
                                    - {{ $recipient->location }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @error('recipient_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Distribusi</label>
                    <input type="date" name="distribution_date" value="{{ old('distribution_date', date('Y-m-d')) }}">

                    @error('distribution_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Barang Bantuan</label>
                    <select name="item_id">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }} - {{ $item->category->name ?? '-' }} | Stok tersedia: {{ $item->stock }} {{ $item->unit }}
                            </option>
                        @endforeach
                    </select>

                    @error('item_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jumlah Keluar</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" placeholder="Contoh: 5">

                    @error('quantity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="notes" placeholder="Contoh: Bantuan disalurkan untuk korban banjir">{{ old('notes') }}</textarea>

                    @error('notes')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Distribusi</button>
                <a href="{{ route('outgoing-distributions.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</body>
</html>