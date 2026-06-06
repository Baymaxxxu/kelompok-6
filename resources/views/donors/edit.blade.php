@extends('layouts.app')

@section('title', 'Edit Donatur - POSKO')
@section('page-subtitle', 'Edit Donatur')

@section('content')

    <div class="section form-wrapper">
        <h2>Edit Donatur</h2>

        <form action="{{ route('donors.update', $donor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Donatur</label>
                <input type="text" name="name" value="{{ old('name', $donor->name) }}">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="phone" value="{{ old('phone', $donor->phone) }}">

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Instansi / Komunitas</label>
                <input type="text" name="institution" value="{{ old('institution', $donor->institution) }}">

                @error('institution')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="address">{{ old('address', $donor->address) }}</textarea>

                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('donors.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection