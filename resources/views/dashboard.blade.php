@extends('layouts.app')

@section('title', 'Dashboard - POSKO')
@section('page-subtitle', 'Dashboard Bantuan Bencana')

@section('content')

    <div class="section">
        <h2>Dashboard Bantuan Bencana</h2>
        <p>
            POSKO digunakan untuk mencatat bantuan masuk, mengelola stok bantuan,
            dan memantau bantuan keluar atau distribusi ke korban maupun lokasi terdampak.
        </p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Kategori</h3>
            <div class="number">{{ $totalCategories }}</div>
        </div>

        <div class="card">
            <h3>Total Barang</h3>
            <div class="number">{{ $totalItems }}</div>
        </div>

        <div class="card">
            <h3>Stok Tersedia</h3>
            <div class="number">{{ $totalStock }}</div>
        </div>

        <div class="card">
            <h3>Bantuan Masuk</h3>
            <div class="number">{{ $totalIncoming }}</div>
        </div>

        <div class="card">
            <h3>Bantuan Keluar</h3>
            <div class="number">{{ $totalOutgoing }}</div>
        </div>
    </div>

    <div class="section">
        <h2>Daftar Stok Barang Bantuan</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data barang bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection