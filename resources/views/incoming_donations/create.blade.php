<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Bantuan Masuk - POSKO</title>

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
    </style>
</head>
<body>

    <div class="navbar">
        <h1>POSKO</h1>
        <span>Input Bantuan Masuk</span>
    </div>

    <div class="container">
        <div class="section">
            <h2>Input Bantuan Masuk</h2>

            <div class="info">
                Data bantuan masuk akan otomatis menambah stok barang bantuan.
            </div>

            <form action="{{ route('incoming-donations.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Donatur</label>
                    <select name="donor_id">
                        <option value="">-- Pilih Donatur --</option>
                        @foreach ($donors as $donor)
                            <option value="{{ $donor->id }}" {{ old('donor_id') == $donor->id ? 'selected' : '' }}>
                                {{ $donor->name }}
                                @if ($donor->institution)
                                    - {{ $donor->institution }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @error('donor_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Bantuan Masuk</label>
                    <input type="date" name="donation_date" value="{{ old('donation_date', date('Y-m-d')) }}">

                    @error('donation_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Barang Bantuan</label>
                    <select name="item_id">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }} - {{ $item->category->name ?? '-' }} | Stok saat ini: {{ $item->stock }} {{ $item->unit }}
                            </option>
                        @endforeach
                    </select>

                    @error('item_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jumlah Masuk</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" placeholder="Contoh: 10">

                    @error('quantity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="notes" placeholder="Contoh: Bantuan diterima dalam kondisi baik">{{ old('notes') }}</textarea>

                    @error('notes')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Bantuan Masuk</button>
                <a href="{{ route('incoming-donations.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</body>
</html>