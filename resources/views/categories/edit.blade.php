@extends('layouts.app')

@section('title', 'Edit Kategori - POSKO')
@section('page-subtitle', 'Edit Kategori Bantuan')

@section('content')

    <div class="section form-wrapper">
        <h2>Edit Kategori Bantuan</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection