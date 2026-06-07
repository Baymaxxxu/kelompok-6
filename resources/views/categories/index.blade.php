@extends('layouts.app')

@section('title', 'Kategori Bantuan - POSKO')
@section('page-subtitle', 'Kategori Bantuan')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Kategori Bantuan</h2>
            @if (auth()->user()->role === 'admin')
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                + Tambah Kategori
            </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    @if (auth()->user()->role === 'admin')
                    <th width="180">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? '-' }}</td>
                        @if (auth()->user()->role === 'admin')
                        <td>
                            <div class="action">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada data kategori bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection