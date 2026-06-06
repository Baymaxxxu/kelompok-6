@extends('layouts.app')

@section('title', 'Barang Bantuan - POSKO')
@section('page-subtitle', 'Barang Bantuan')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Barang Bantuan</h2>
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                + Tambah Barang
            </a>
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
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <span class="badge">
                                {{ $item->category->name ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                        <td>
                            <div class="action">
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data barang bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection