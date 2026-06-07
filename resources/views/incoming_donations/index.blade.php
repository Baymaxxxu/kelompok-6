@extends('layouts.app')

@section('title', 'Bantuan Masuk - POSKO')
@section('page-subtitle', 'Bantuan Masuk')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Bantuan Masuk</h2>
            <a href="{{ route('incoming-donations.create') }}" class="btn btn-primary">
                + Input Bantuan Masuk
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
                    <th>Donatur</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th width="210">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incomingDonations as $donation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($donation->donation_date)->format('d-m-Y') }}</td>
                        <td>{{ $donation->donor->name ?? '-' }}</td>
                        <td>
                            @foreach ($donation->details as $detail)
                                <div>{{ $detail->item->name ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($donation->details as $detail)
                                <span class="badge badge-green">
                                    +{{ $detail->quantity }} {{ $detail->item->unit ?? '' }}
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $donation->notes ?? '-' }}</td>
                        <td>
                            <div class="action">
                                <a href="{{ route('incoming-donations.show', $donation->id) }}" class="btn btn-info">
                                    Detail
                                </a>

                                @if (auth()->user()->role === 'admin')
                                <form action="{{ route('incoming-donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data bantuan masuk ini? Stok barang akan dikurangi kembali.')">
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
                            Belum ada data bantuan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection