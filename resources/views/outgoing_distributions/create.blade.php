@extends('layouts.app')

@section('title', 'Input Distribusi Bantuan - POSKO')
@section('page-subtitle', 'Input Bantuan Keluar / Distribusi')

@section('content')

    <div class="section form-wrapper">
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

@endsection