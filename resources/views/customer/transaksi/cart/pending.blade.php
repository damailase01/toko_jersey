@extends('layouts.app')

@section('title', 'Toko Jersey')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/transaksi/pending.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="page-header">
        <h1>Detail Pembayaran</h1>
        <p class="subtitle">Status pembayaran untuk pesanan Anda</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Order Details -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Detail Pesanan #ORD{{ $order->id }}</div>
                <div class="status-badge pending">
                    @if ($order->status == 'pending')
                        Menunggu Konfirmasi
                    @elseif ($order->status == 'process')
                        Sedang Dikirim
                    @elseif ($order->status == 'success')
                        Berhasil
                    @endif
                    
                
                </div>
            </div>

            <div class="order-info">
                <div class="info-grid">
                    <div class="info-item">
                        <h4>Tanggal Pesanan</h4>
                        <p>{{ $order->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Metode Pengiriman</h4>
                        @if ($order->courier == 'jne')
                            <p>JNE Regular (2-3 hari)</p>
                        @elseif ($order->courier == 'tiki')
                            <p>TIKI Express (1-2 hari)</p>
                        @elseif ($order->courier == 'pos')
                            <p>POS Indonesia (3-5 hari)</p>
                        @else
                            <p>Metode pengiriman tidak diketahui</p>
                        @endif
                    </div>
                    <div class="info-item">
                        <h4>Alamat Pengiriman</h4>
                        <p>{{$order->address}}, {{$order->city}}</p>
                    </div>
                </div>
            </div>

            <div class="items-list">
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('storage/' . $order->product->image_main) }}" alt="{{ $order->product->name }}">
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $order->product->name }}</div>
                        <div class="item-meta">
                            Ukuran: {{ $order->size }} • Quantity: {{ $order->quantity }}
                        </div>
                        <div class="item-price"> Rp {{ number_format($order->price * $order->quantity , 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Proof -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Bukti Pembayaran</div>
            </div>
            <div class="proof-section">
                @if($order->status == 'pending')
                    <div class="status-message">
                        <div class="status-icon">⏳</div>
                        <div class="status-text">
                            <h4>Pembayaran Sedang Diverifikasi</h4>
                            <p>Mohon tunggu 1x24 jam untuk proses verifikasi pembayaran Anda</p>
                        </div>
                    </div>
                @elseif($order->status == 'process')
                    <div class="status-message">
                        <div class="status-icon">🚚</div>
                        <div class="status-text">
                            <h4>Pesanan Sedang Dikirim</h4>
                            <p>Pesanan Anda sedang dalam proses pengiriman</p>
                        </div>
                    </div>
                @elseif($order->status == 'success')
                    <div class="status-message">
                        <div class="status-icon">✅</div>
                        <div class="status-text">
                            <h4>Pembayaran Berhasil</h4>
                            <p>Pesanan Anda akan segera diproses</p>
                        </div>
                    </div>
                @endif

                <div class="payment-info">
                    <div class="payment-info-grid">
                        <div class="payment-info-item">
                            <h4>Bank Tujuan</h4>
                            @if ($order->payment_method == 'bca')
                                <p>Bank BCA</p>
                            @elseif ($order->payment_method == 'bsi')
                                <p>Bank BSI</p>
                            @endif  
                        </div>
                        <div class="payment-info-item">
                            <h4>Nomor Rekening</h4>
                            <p>8735261904</p>
                        </div>
                        <div class="payment-info-item">
                            <h4>Waktu Transfer</h4>
                            <p>{{ $order->updated_at ? $order->updated_at->format('d M Y') : 'Tanggal tidak tersedia' }}</p>
                        </div>
                        <div class="payment-info-item">
                            <h4>Status</h4>
                            <p>
                                @if($order->status == 'pending')
                                    Menunggu Konfirmasi
                                @elseif($order->status == 'process')
                                    Sedang Dikirim
                                @elseif($order->status == 'success')
                                    Berhasil
                                @endif  
                            </p>
                        </div>
                    </div>
                </div>

                <img src="{{ asset('storage/payment_proofs/' . basename($order->payment_proof)) }}" alt="Bukti Transfer" class="proof-image">


            </div>
        </div>
    </div>

    <!-- Payment Summary -->
    <div class="payment-summary">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Ringkasan Pembayaran</div>
            </div>
            <div class="summary-list">
                <div class="summary-item">
                    <span>Subtotal Produk</span>
                    <span>
                        Rp {{ number_format($order->price * $order->quantity, 0, ',', '.') }}
                    </span>
                </div>
                <div class="summary-item">
                    <span>Ongkos Kirim</span>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>Rp {{ number_format(($order->price * $order->quantity) + $order->shipping_cost, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>