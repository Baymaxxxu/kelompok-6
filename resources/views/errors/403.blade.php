@extends('layouts.app')

@section('title', 'Akses Ditolak - POSKO')
@section('page-subtitle', 'Akses Ditolak')

@section('content')

    <div class="section form-wrapper">
        <h2>Akses Ditolak</h2>

        <div class="role-info">
            <strong>403:</strong> Anda tidak memiliki akses ke halaman ini.
            Fitur ini hanya dapat dilakukan oleh Admin.
        </div>

        <p>
            Anda sedang login sebagai:
            <strong>{{ ucfirst(auth()->user()->role ?? 'User') }}</strong>
        </p>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Kembali ke Dashboard
        </a>
    </div>

@endsection