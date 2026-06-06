@extends('layouts.app')

@section('title', 'Tambah Donatur - POSKO')
@section('page-subtitle', 'Tambah Donatur')

@section('content')

    <div class="section form-wrapper">
        <h2>Tambah Donatur</h2>

        <form action="{{ route('donors.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Donatur</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso">

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
                <label>Instansi / Komunitas</label>
                <input type="text" name="institution" value="{{ old('institution') }}" placeholder="Contoh: Komunitas Peduli Bencana">

                @error('institution')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="address" placeholder="Masukkan alamat donatur">{{ old('address') }}</textarea>

                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('donors.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection