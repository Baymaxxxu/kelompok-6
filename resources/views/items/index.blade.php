@extends('layouts.app')

@section('title', 'Barang Bantuan - POSKO')
@section('page-subtitle', 'Barang Bantuan')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Barang Bantuan</h2>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    + Tambah Barang
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (auth()->user()->role === 'petugas')
            <div class="role-info">
                <strong>Info Akses:</strong> Anda login sebagai Petugas. Fitur tambah, edit, dan hapus barang bantuan hanya dapat dilakukan oleh Admin.
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

                    @if (auth()->user()->role === 'admin')
                        <th width="180">Aksi</th>
                    @endif
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

                        @if (auth()->user()->role === 'admin')
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
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 7 : 6 }}" class="empty">
                            Belum ada data barang bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection