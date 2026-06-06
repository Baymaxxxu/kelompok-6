@extends('layouts.app')

@section('title', 'Laporan POSKO')
@section('page-subtitle', 'Laporan Stok dan Riwayat Bantuan')

@section('content')

    <div class="section-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <h1>Laporan POSKO</h1>
        <button onclick="window.print()" class="print-btn">Cetak Laporan</button>
    </div>

    <div class="cards" style="grid-template-columns: repeat(3, 1fr);">
        <div class="card">
            <h3>Total Stok Tersedia</h3>
            <div class="number">{{ $totalStock }}</div>
        </div>

        <div class="card">
            <h3>Total Bantuan Masuk</h3>
            <div class="number">{{ $totalIncoming }}</div>
        </div>

        <div class="card">
            <h3>Total Bantuan Keluar</h3>
            <div class="number">{{ $totalOutgoing }}</div>
        </div>
    </div>

    <div class="section">
        <h2>Laporan Stok Barang</h2>

        <table>
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok Tersedia</th>
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
                        <td>
                            <strong>{{ $item->stock }}</strong>
                        </td>
                        <td>{{ $item->description ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Riwayat Bantuan Masuk</h2>

        <table>
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Tanggal</th>
                    <th>Donatur</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada riwayat bantuan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Riwayat Bantuan Keluar / Distribusi</h2>

        <table>
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Tanggal</th>
                    <th>Penerima / Lokasi</th>
                    <th>Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Catatan</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada riwayat distribusi bantuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection