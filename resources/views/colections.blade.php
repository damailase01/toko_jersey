@extends('layouts.app')

@section('title', 'Toko Jersey')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/colections.css') }}">
<style>
    .product-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }
</style>
@endpush

@section('content')

<div class="products-section">
    <div class="container">
        <div class="product-wrapper">
            <div class="filter-section">
                <h2>Filter</h2>
                <div class="filter-group">
                    <h3>Kategori</h3>
                    <select id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        {{-- <option value="electronics">Elektronik</option>
                        <option value="fashion">Fashion</option>
                        <option value="home">Peralatan Rumah</option> --}}
                    </select>
                </div>

                <div class="filter-group">
                    <h3>Harga</h3>
                    <select id="priceFilter">
                        <option value="">Semua Harga</option>
                        <option value="0-100000">Dibawah Rp 100.000</option>
                        <option value="100000-500000">Rp 100.000 - Rp 500.000</option>
                        <option value="500000-1000000">Rp 500.000 - Rp 1.000.000</option>
                        <option value="1000000">Diatas Rp 1.000.000</option>
                    </select>
                </div>

                <div class="filter-group">
                    <h3>Rating</h3>
                    <select id="ratingFilter">
                        <option value="">Semua Rating</option>
                        <option value="4">4+ Bintang</option>
                        <option value="3">3+ Bintang</option>
                        <option value="2">2+ Bintang</option>
                    </select>
                </div>
            </div>

            <div class="product-content">
                <div class="section-header">
                    <h2>Katalog Produk</h2>
                    <div class="sort-section">
                        <select id="sortFilter">
                            <option value="newest">Terbaru</option>
                            <option value="price-low">Harga Terendah</option>
                            <option value="price-high">Harga Tertinggi</option>
                            <option value="rating">Rating Tertinggi</option>
                        </select>
                    </div>
                </div>

<div class="product-grid">
    @foreach ($products as $product)
    <a href="{{ route('produk.detail', $product->id) }}" class="product-link">
        <div class="product-card">
            <div class="product-image-wrapper">
                <img src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" class="product-image">
                @if ($product->price < $product->original_price)
                    <div class="discount-tag">
                        {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                    </div>
                @endif
                <div class="product-labels">
                    @if ($product->features['cashback'] ?? false)
                        <span class="cashback">Cashback</span>
                    @endif
                    @if ($product->features['free_shipping'] ?? false)
                        <span class="free-shipping">Free Shipping</span>
                    @endif
                </div>
            </div>
            <div class="product-info">
                <div class="product-title">{{ $product->name }}</div>
                <div class="price-section">
                    @if ($product->price < $product->original_price)
                        <div class="original-price">Rp{{ number_format($product->original_price, 0, ',', '.') }}</div>
                    @endif
                    <div class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
                <div class="product-stats">
                    <div class="rating">
                        <i class="fas fa-star"></i> {{ $product->features['rating'] ?? 4 }}
                    </div>
                    <div>Terjual {{ $product->stock }}</div>
                </div>
                <div class="location">{{ $product->features['location'] ?? 'Medan' }}</div>
            </div>
        </div>
    </a>
    @endforeach
</div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/colections.js') }}"></script>
@endpush
