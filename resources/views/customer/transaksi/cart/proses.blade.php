@extends('layouts.app')

@section('title', 'Toko Jersey')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/transaksi/proses.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<div class="container">
    <!-- Header Section -->
    <header class="page-header">
        <h1>Pesanan Saya</h1>
        <p class="subtitle">Lacak dan kelola semua pesanan Anda</p>
    </header>

    <!-- Order Categories -->
    <div class="order-categories">
        <div class="category-tabs">
            @foreach(['unpaid', 'pending', 'process', 'success'] as $status)
            <button class="tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $status }}">
                <i class="fas {{ $status == 'unpaid' ? 'fa-clock' : ($status == 'pending' ? 'fa-hourglass-half' : ($status == 'process' ? 'fa-spinner' : 'fa-check-circle')) }}"></i>
                {{ ucfirst($status) }}
                <span class="count">{{ $orders[$status]->count() }}</span>
            </button>
        @endforeach
        </div>
    </div>

    <!-- Orders List Section -->
    <div class="orders-section">
        @foreach(['unpaid', 'pending', 'process', 'success'] as $status)
    <div class="tab-content {{ $loop->first ? 'active' : '' }}" id="{{ $status }}">
        @forelse ($orders[$status] as $order)
            <div class="order-card">
                <div class="order-header">
                    <div class="order-info">
                        <h3>#ORD{{ $order->id }}</h3>
                        <span class="order-date">
                            {{ $order->created_at ? $order->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                        </span>
                    </div>
                    @if ($status == 'unpaid')
                    <div class="payment-timer">
                        Sisa waktu pembayaran: 
                        {{ $order->created_at ? $order->created_at->addDays(2)->diffForHumans() : 'Tidak tersedia' }}
                    </div>
                    @endif
                </div>
                <div class="order-items">
                    <!-- Menampilkan item terkait dengan pesanan -->
                    <div class="item-image">
                        <img src="{{ asset('storage/' . $order->product->image_main) }}" alt="{{ $order->product->name }}">
                    </div>
                    <div class="item-details">
                        <h4>{{ $order->product->name }}</h4>
                        <p class="item-meta">Ukuran: {{ $order->size }} • Quantity: {{ $order->quantity }}</p>
                        <p class="item-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="order-footer">
                    <div class="total-section">
                        <span>Total Pesanan:</span>
                        <span class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="action-buttons">
                        @if ($status == 'unpaid')
                            <button class="btn btn-primary" onclick="window.location.href='{{route('bayar-sekarang', $order->id) }}'">Bayar Sekarang</button>
                            <button class="btn btn-secondary">Batalkan</button>
                        @elseif ($status == 'process')
                            <form action="{{ route('order.succes', $order->id) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-primary" >Pesanan Telah Sampai?</button>
                            </form>
                            <button class="btn btn-secondary" onclick="window.location.href='{{route('pending.page', $order->id) }}'">Lihat Detail</button>
                        @else
                            <button class="btn btn-secondary" onclick="window.location.href='{{route('pending.page', $order->id) }}'">Lihat Detail</button>
                            
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada pesanan dalam status ini.</p>
        @endforelse
    </div>
@endforeach

    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/proses.js') }}"></script>
@endpush
