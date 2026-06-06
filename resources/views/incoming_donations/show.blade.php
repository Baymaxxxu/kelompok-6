@extends('layouts.app')

@section('title', 'Detail Bantuan Masuk - POSKO')
@section('page-subtitle', 'Detail Bantuan Masuk')

@section('content')

    <div class="section form-wrapper">
        <h2>Detail Bantuan Masuk</h2>

        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($incomingDonation->donation_date)->format('d-m-Y') }}</p>
        <p><strong>Donatur:</strong> {{ $incomingDonation->donor->name ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $incomingDonation->notes ?? '-' }}</p>

        <h3>Barang Bantuan</h3>

        <table>
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomingDonation->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->item->name ?? '-' }}</td>
                        <td>
                            <span class="badge">
                                {{ $detail->item->category->name ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-green">
                                +{{ $detail->quantity }}
                            </span>
                        </td>
                        <td>{{ $detail->item->unit ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('incoming-donations.index') }}" class="btn btn-secondary" style="margin-top: 20px;">
            Kembali
        </a>
    </div>

@endsection