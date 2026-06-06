@extends('layouts.app')

@section('title', 'Tambah Penerima - POSKO')
@section('page-subtitle', 'Tambah Penerima / Lokasi Tujuan')

@section('content')

    <div class="section form-wrapper">
        <h2>Tambah Penerima / Lokasi Tujuan</h2>

        <form action="{{ route('recipients.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Penerima / Posko Tujuan</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Posko Pengungsian Kecamatan A">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890">

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Rangkasbitung, Banten">

                @error('location')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="address" placeholder="Masukkan alamat lengkap penerima atau lokasi tujuan">{{ old('address') }}</textarea>

                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Catatan</label>
                <textarea name="notes" placeholder="Contoh: Korban banjir, membutuhkan sembako dan pakaian">{{ old('notes') }}</textarea>

                @error('notes')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('recipients.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection