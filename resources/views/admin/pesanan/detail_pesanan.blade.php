@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/pesanan/detail_pesanan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<div class="main-content">
    <div class="page-header">
        <div class="header-left">
            <a href="{{route('transaksi.view.admin')}}" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2>Detail Pesanan #ORD{{$order->id}}</h2>
        </div>
        <div class="header-right">
            <span class="status-badge status-pending">
                {{$order->status}}
            </span>
        </div>
    </div>

    <div class="order-detail-container">
        <div class="order-grid">
            <!-- Informasi Pesanan -->
            <div class="detail-card">
                <h3>Informasi Pesanan</h3>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="label">ID Pesanan</span>
                        <span class="value">#ORD{{$order->id}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Tanggal Pesanan</span>
                        <span class="value">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Status</span>
                        <span class="value">{{$order->status}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Metode Pembayaran</span>
                        @if ($order->payment_method == 'bca')
                            <span class="value">Transfer Bank BCA</span>
                    
                        @elseif ($order->payment_method == 'bsi')
                            <span class="value">Transfer Bank BSI</span>
                    
                        @endif
                        
                    </div>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="detail-card">
                <h3>Informasi Pelanggan</h3>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="label">ID Pelanggan</span>
                        <span class="value">#USR{{$order->user->id}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Alamat</span>
                        <span class="value">{{$order->address}} </span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Kota</span>
                        <span class="value">
                            {{$order->city}}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="detail-card">
                <h3>Informasi Pengiriman</h3>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="label">Kurir</span>
                        @if ($order->courier == 'jne')
                            <span class="value">JNE</span>
                        @elseif ($order->courier == 'tiki')
                            <span class="value">TIKI</span>
                        @elseif ($order->courier == 'pos')
                            <span class="value">POS</span>
                        @else
                            <p>Metode pengiriman tidak diketahui</p>
                        @endif
                    </div>
                    <div class="detail-row">
                        <span class="label">Biaya Pengiriman</span>
                        <span class="value">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Rincian Produk -->
            <div class="detail-card full-width">
                <h3>Rincian Produk</h3>
                <div class="detail-content" style="padding-bottom: 40px">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Foto Produk</th>
                                <th>Produk ID</th>
                                <th>Ukuran</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . $order->product->image_main) }}" alt="Jersey">
                                        <a href="#" class="view-image">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>#PRD{{$order->product_id}}</td>
                                <td> {{ $order->size }} </td>
                                <td>
                                    {{ $order->quantity }}
                                </td>
                                <td>
                                    Rp {{ number_format($order->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($order->price* $order->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Subtotal</td>
                                <td>Rp {{ number_format($order->price* $order->quantity, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Biaya Pengiriman</td>
                                <td>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="total-row">
                                <td colspan="5">Total</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <h3>Bukti Pembayaran</h3>
                <div class="product-image">
                    <img src="{{ asset('storage/payment_proofs/' . basename($order->payment_proof)) }}" alt="Jersey">
                    <a href="#" class="view-image">
                        <i class="fas fa-search-plus"></i>
                    </a>
                </div>
            </div>
            
        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="modalImage" src="{{ asset('storage/payment_proofs/' . basename($order->payment_proof)) }}" alt="Jersey Large">
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="action-buttons">
            @if ($order->status == 'pending')
            <form action="{{ route('order.process', $order->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-process">Proses Pesanan</button>
            </form>
            @endif

            {{-- <button class="btn btn-cancel">Batalkan Pesanan</button> --}}
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/admin/pesanan/detail_pesanan.js') }}"></script>
@endpush