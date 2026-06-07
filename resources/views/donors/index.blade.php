@extends('layouts.app')

@section('title', 'Donatur - POSKO')
@section('page-subtitle', 'Data Donatur')

@section('content')

    <div class="section">
        <div class="header">
            <h2>Data Donatur</h2>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('donors.create') }}" class="btn btn-primary">
                    + Tambah Donatur
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
                    <th>Nama Donatur</th>
                    <th>No. HP</th>
                    <th>Instansi</th>
                    <th>Alamat</th>

                    @if (auth()->user()->role === 'admin')
                        <th width="180">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($donors as $donor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $donor->name }}</td>
                        <td>{{ $donor->phone ?? '-' }}</td>
                        <td>{{ $donor->institution ?? '-' }}</td>
                        <td>{{ $donor->address ?? '-' }}</td>

                        @if (auth()->user()->role === 'admin')
                            <td>
                                <div class="action">
                                    <a href="{{ route('donors.edit', $donor->id) }}" class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('donors.destroy', $donor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus donatur ini?')">
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
                        <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="empty">
                            Belum ada data donatur.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection