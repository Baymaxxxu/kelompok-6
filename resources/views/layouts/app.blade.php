<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSKO')</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f8;
            color: #1f2937;
        }

        .navbar {
            background: #1e40af;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .navbar-brand h1 {
            margin: 0;
            font-size: 28px;
        }

        .navbar-brand span {
            display: block;
            margin-top: 4px;
            font-size: 15px;
            opacity: 0.9;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        .navbar-menu a:hover {
            text-decoration: underline;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 10px;
            padding-left: 16px;
            border-left: 1px solid rgba(255, 255, 255, 0.35);
        }

        .navbar-user span {
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .container {
            padding: 30px 40px;
        }

        .section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .section h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .card h3 {
            margin: 0 0 12px 0;
            font-size: 14px;
            color: #6b7280;
            font-weight: normal;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
            color: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #eff6ff;
        }

        table th,
        table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
            vertical-align: top;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #1e40af;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-info {
            background: #0ea5e9;
            color: white;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .role-info {
            background: #fef3c7;
            color: #92400e;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid #f59e0b;
        }

        .role-info strong {
            color: #78350f;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1e40af;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-green {
            background: #dcfce7;
            color: #166534;
        }

        .badge-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .action {
            display: flex;
            gap: 8px;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 25px;
        }

        .info {
            background: #eff6ff;
            color: #1e40af;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .warning {
            background: #fef3c7;
            color: #92400e;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .form-wrapper {
            max-width: 800px;
        }

        .print-btn {
            background: #1e40af;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        @media print {
            .navbar,
            .print-btn {
                display: none;
            }

            body {
                background: white;
            }

            .container {
                padding: 0;
            }

            .section,
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar {
                display: block;
                padding-left: 20px;
                padding-right: 20px;
            }

            .navbar-menu {
                justify-content: flex-start;
                margin-top: 14px;
            }

            .navbar-user {
                border-left: none;
                padding-left: 0;
                margin-left: 0;
            }

            .container {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 600px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .header {
                display: block;
            }

            .header .btn {
                margin-top: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand">
            <h1>POSKO</h1>
            <span>@yield('page-subtitle', 'Sistem Informasi Pendataan dan Penyaluran Bantuan Bencana')</span>
        </div>

        <div class="navbar-menu">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('categories.index') }}">Kategori</a>
            <a href="{{ route('items.index') }}">Barang</a>
            <a href="{{ route('donors.index') }}">Donatur</a>
            <a href="{{ route('recipients.index') }}">Penerima</a>
            <a href="{{ route('incoming-donations.index') }}">Bantuan Masuk</a>
            <a href="{{ route('outgoing-distributions.index') }}">Distribusi</a>
            <a href="{{ route('reports.index') }}">Laporan</a>

            <div class="navbar-user">
                <span>
                    {{ auth()->user()->name ?? '' }}
                    @if (auth()->check())
                        ({{ ucfirst(auth()->user()->role) }})
                    @endif
                </span>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>