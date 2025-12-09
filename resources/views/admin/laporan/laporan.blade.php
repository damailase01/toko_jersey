@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/laporan.css') }}">
<style>
    @media print {
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .container {
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .header, .filter-section {
        display: none; /* Sembunyikan bagian header dan filter pada saat print */
    }
    .table-section table {
        width: 100%;
        border-collapse: collapse;
    }
    .table-section th, .table-section td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .table-section th {
        background-color: #f2f2f2;
    }
    .stat-card {
        display: none; /* Sembunyikan statistik jika tidak diperlukan saat print */
    }
}

</style>
@endpush

@section('content')
@section('content')
<div class="container">
    <!-- Header dengan Filter -->
    <div class="header">
        <h1>Laporan Keuangan</h1>
        <div class="filter-section">
            <form method="GET" action="{{ route('laporan.keuangan') }}">
                <input type="date" name="start_date" value="{{ old('start_date', $startDate->format('Y-m-d')) }}">
                <input type="date" name="end_date" value="{{ old('end_date', $endDate->format('Y-m-d')) }}">
                <button type="submit">Tampilkan</button>
            </form>
            
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Pendapatan (Semua)</h3>
            <div class="amount">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>
        <div class="stat-card">
            <h3>Pendapatan Bulan Ini</h3>
            <div class="amount">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
        </div>
        <div class="stat-card">
            <h3>Pendapatan Hari Ini</h3>
            <div class="amount">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Tabel Order -->
    <div class="table-section">
        <h2>Daftar Order</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>No. Order</th>
                    <th>Nama Customer</th>
                    <th class="text-right">Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>#ORD{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="status-completed">{{$order->status}}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@endsection