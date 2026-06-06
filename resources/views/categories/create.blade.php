@extends('layouts.app')

@section('title', 'Tambah Kategori - POSKO')
@section('page-subtitle', 'Tambah Kategori Bantuan')

@section('content')

    <div class="section form-wrapper">
        <h2>Tambah Kategori Bantuan</h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Sembako">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection