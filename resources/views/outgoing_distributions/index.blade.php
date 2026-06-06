@extends('layouts.app')

@section('title', 'Distribusi Bantuan - POSKO')
@section('page-subtitle', 'Bantuan Keluar / Distribusi')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Distribusi Bantuan</h2>
            <a href="{{ route('outgoing-distributions.create') }}" class="btn btn-primary">
                + Input Distribusi
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
                    <th>Tanggal</th>
                    <th>Penerima / Lokasi</th>
                    <th>Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Catatan</th>
                    <th width="210">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outgoingDistributions as $distribution)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($distribution->distribution_date)->format('d-m-Y') }}</td>
                        <td>{{ $distribution->recipient->name ?? '-' }}</td>
                        <td>
                            @foreach ($distribution->details as $detail)
                                <div>{{ $detail->item->name ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($distribution->details as $detail)
                                <span class="badge badge-red">
                                    -{{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $distribution->notes ?? '-' }}</td>
                        <td>
                            <div class="action">
                                <a href="{{ route('outgoing-distributions.show', $distribution->id) }}" class="btn btn-info">
                                    Detail
                                </a>

                                <form action="{{ route('outgoing-distributions.destroy', $distribution->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data distribusi ini? Stok barang akan dikembalikan.')">
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
                            Belum ada data distribusi bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection