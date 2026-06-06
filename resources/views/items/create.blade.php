@extends('layouts.app')

@section('title', 'Tambah Barang - POSKO')
@section('page-subtitle', 'Tambah Barang Bantuan')

@section('content')

    <div class="section form-wrapper">
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

@endsection