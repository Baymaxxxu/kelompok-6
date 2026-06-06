@extends('layouts.app')

@section('title', 'Edit Penerima - POSKO')
@section('page-subtitle', 'Edit Penerima / Lokasi Tujuan')

@section('content')

    <div class="section form-wrapper">
        <h2>Edit Penerima / Lokasi Tujuan</h2>

        <form action="{{ route('recipients.update', $recipient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Penerima / Posko Tujuan</label>
                <input type="text" name="name" value="{{ old('name', $recipient->name) }}">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="phone" value="{{ old('phone', $recipient->phone) }}">

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $recipient->location) }}">

                @error('location')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="address">{{ old('address', $recipient->address) }}</textarea>

                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Catatan</label>
                <textarea name="notes">{{ old('notes', $recipient->notes) }}</textarea>

                @error('notes')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('recipients.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection