@extends('layouts.app')

@section('title', 'Input Bantuan Masuk - POSKO')
@section('page-subtitle', 'Input Bantuan Masuk')

@section('content')

    <div class="section form-wrapper">
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

@endsection