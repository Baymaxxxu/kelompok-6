@extends('layouts.app')

@section('title', 'Detail Distribusi Bantuan - POSKO')
@section('page-subtitle', 'Detail Bantuan Keluar / Distribusi')

@section('content')

    <div class="section form-wrapper">
        <h2>Detail Distribusi Bantuan</h2>

        <p><strong>Tanggal Distribusi:</strong> {{ \Carbon\Carbon::parse($outgoingDistribution->distribution_date)->format('d-m-Y') }}</p>
        <p><strong>Penerima / Tujuan:</strong> {{ $outgoingDistribution->recipient->name ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $outgoingDistribution->recipient->location ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $outgoingDistribution->notes ?? '-' }}</p>

        <h3>Barang yang Disalurkan</h3>

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
                @foreach ($outgoingDistribution->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->item->name ?? '-' }}</td>
                        <td>
                            <span class="badge">
                                {{ $detail->item->category->name ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-red">
                                -{{ $detail->quantity }}
                            </span>
                        </td>
                        <td>{{ $detail->item->unit ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('outgoing-distributions.index') }}" class="btn btn-secondary" style="margin-top: 20px;">
            Kembali
        </a>
    </div>

@endsection