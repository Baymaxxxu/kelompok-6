<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - POSKO</title>

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
            max-width: 760px;
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
    </style>
</head>
<body>

    <div class="navbar">
        <h1>POSKO</h1>
        <span>Tambah Barang Bantuan</span>
    </div>

    <div class="container">
        <div class="section">
            <h2>Tambah Barang Bantuan</h2>

            <form action="{{ route('items.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Beras">

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Contoh: kg, pcs, dus, pack">

                    @error('unit')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0">

                    @error('stock')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="description" placeholder="Masukkan keterangan barang">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</body>
</html>