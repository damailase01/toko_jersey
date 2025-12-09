@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/pesanan/pesanan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Gaya umum untuk tombol */
.btn {
    display: inline-block;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

/* Tombol "Detail" */
.btn-primary {
    background-color: #007bff;
    color: #ffffff;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.btn-primary:active {
    background-color: #004494;
    transform: scale(0.95);
}

/* Tombol "Edit" */
.btn-warning {
    background-color: #ffc107;
    color: #ffffff;
}

.btn-warning:hover {
    background-color: #e0a800;
    transform: scale(1.05);
}

.btn-warning:active {
    background-color: #c69500;
    transform: scale(0.95);
}

/* Untuk meningkatkan pengalaman pengguna */
.btn:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

</style>
@endpush

@section('content')
    <div class="main-content">
        <div class="dashboard-header">
            <div class="header-left">
                <h2>Pesanan</h2>
                <div class="date-today" id="currentDate"></div>
            </div>
        </div>

        <div class="orders-container">
            <div class="orders-header">
                <div class="header-wrapper">
                    <h3>Daftar Pesanan</h3>
                    <span class="subtitle">Kelola semua pesanan jersey</span>
                </div>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" class="search-input" placeholder="Cari pesanan...">
                    </div>
                </div>
            </div>

            <div class="tabs">
                <button class="tab-btn active" data-tab="pending">
                    Pending <span class="count pending-count">{{ $pendingCount }}</span>
                </button>
                <button class="tab-btn" data-tab="process">
                    Proses <span class="count process-count">{{ $processCount }}</span>
                </button>
                <button class="tab-btn" data-tab="success">
                    Selesai <span class="count complete-count">{{ $successCount }}</span>
                </button>
                <button class="tab-btn" data-tab="unpaid">
                    Unpaid <span class="count complete-count">{{ $unpaidCount }}</span>
                </button>
            </div>

            <div class="tab-content active" id="pending">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingOrders as $order)
                            <tr>
                                <td>#ORD{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>
                                    <a href="{{ route('transaksi.detail.admin', $order->id) }}" class="btn btn-primary btn-sm">Tinjau</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-content" id="process">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($processOrders as $order)
                        <tr>
                            <td>#ORD{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('transaksi.detail.admin', $order->id) }}" class="btn btn-primary btn-sm">Detail</a>
                               
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-content" id="success">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksii</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completeOrders as $order)
                        <tr>
                            <td>#ORD{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('transaksi.detail.admin', $order->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-content" id="unpaid">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksii</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waitingOrders as $order)
                        <tr>
                            <td>#ORD{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('transaksi.detail.admin', $order->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
@endsection

@push('scripts')
<script src="{{ asset('js/admin/pesanan/pesanan.js') }}"></script>
@endpush
