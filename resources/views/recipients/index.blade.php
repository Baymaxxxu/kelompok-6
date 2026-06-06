@extends('layouts.app')

@section('title', 'Penerima Bantuan - POSKO')
@section('page-subtitle', 'Penerima / Lokasi Tujuan')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Penerima / Lokasi Tujuan</h2>
            <a href="{{ route('recipients.create') }}" class="btn btn-primary">
                + Tambah Penerima
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
                    <th>Nama Penerima</th>
                    <th>No. HP</th>
                    <th>Lokasi</th>
                    <th>Alamat</th>
                    <th>Catatan</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recipients as $recipient)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $recipient->name }}</td>
                        <td>{{ $recipient->phone ?? '-' }}</td>
                        <td>{{ $recipient->location ?? '-' }}</td>
                        <td>{{ $recipient->address ?? '-' }}</td>
                        <td>{{ $recipient->notes ?? '-' }}</td>
                        <td>
                            <div class="action">
                                <a href="{{ route('recipients.edit', $recipient->id) }}" class="btn btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('recipients.destroy', $recipient->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data penerima ini?')">
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
                            Belum ada data penerima atau lokasi tujuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection