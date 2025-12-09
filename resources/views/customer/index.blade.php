@extends('layouts.app')

@section('title', 'Toko Jersey')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<style>
    .product-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }
</style>
@endpush

@section('content')
<div class="hero-section">
    <div class="hero-content">
        <h1>Jersey Berkualitas Premium</h1>
        <p>Koleksi jersey original dari berbagai klub dan timnas</p>
        <div class="hero-buttons">
            <a href="{{route('colections')}}" class="shop-now">Koleksi Terbaru</a>
            <a href="{{route('colections')}}" class="view-more">Best Seller</a>
        </div>
    </div>
</div>

<div class="features-section">
    <div class="feature">
        <i class="fas fa-shipping-fast"></i>
        <h3>Pengiriman Cepat</h3>
        <p>1-3 hari sampai</p>
    </div>
    <div class="feature">
        <i class="fas fa-certificate"></i>
        <h3>100% Original</h3>
        <p>Garansi keaslian</p>
    </div>
    <div class="feature">
        <i class="fas fa-sync"></i>
        <h3>14 Hari Return</h3>
        <p>Garansi uang kembali</p>
    </div>
</div>

<!-- Bagian Header atau Navbar bisa diletakkan di atas -->

<section class="products-section">
    <div class="container">
        <div class="section-header">
            <h2>Jersey Terpopuler</h2>
            <a href="" class="see-all">Lihat Semua ></a>
        </div>

        <div class="product-grid">
            @foreach ($products as $product)
            <!-- Product Card -->
            <article class="product-card">
                <a href="{{ route('produk.detail', $product->id) }}" class="product-link">
                    <div class="product-image-wrapper">
                        <!-- Tag diskon jika ada -->
                        <div class="discount-tag">25% OFF</div>
                        <div class="favorite-button">
                            <i class="far fa-heart"></i>
                        </div>
                        <!-- Menampilkan gambar produk -->
                        <img src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" class="product-image">
                        <div class="mall-tag">Mall</div>
                    </div>

                    <div class="product-info">
                        <div class="product-title">
                            <img src="{{ asset('images/official.jpg') }}" alt="Official Store" class="official-badge">
                            {{ $product->name }}
                        </div>

                        <div class="price-section">
                            <div class="original-price">Rp 800.000</div>
                            <div class="current-price">Rp {{ number_format($product->price * 0.75, 0, ',', '.') }}</div>
                        </div>

                        <div class="product-stats">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <span>4.9</span>
                            </div>
                            <div class="sold">Terjual 1,2RB</div>
                        </div>

                        <div class="location">Jakarta Pusat</div>
                    </div>

                    <div class="product-labels">
                        <span class="cashback">Cashback</span>
                        <span class="free-shipping">Gratis Ongkir</span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>


<div class="banner-section">
    <div class="banner-content">
        <h2>Special Edition</h2>
        <p>Dapatkan jersey edisi spesial dengan tanda tangan pemain</p>
        <a href="#" class="banner-button">Lihat Koleksi</a>
    </div>
</div>

<div id="best-seller" class="categories-section">
    <h2>Best Seller</h2>
    <div class="category-grid">
        <div class="category-card">
            <img src="{{ asset('images/images.jpg') }}" alt="Liga Inggris">
            <div class="category-content">
                <h3>Liga Inggris</h3>
                <p>50+ Jersey</p>
                <a href="{{route('colections')}}" class="category-button">Lihat Semua</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('images/tes.jpg') }}" alt="Liga Spanyol">
            <div class="category-content">
                <h3>Liga Spanyol</h3>
                <p>40+ Jersey</p>
                <a href="{{route('colections')}}" class="category-button">Lihat Semua</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('images/images2.jpg') }}" alt="Tim Nasional">
            <div class="category-content">
                <h3>Tim Nasional</h3>
                <p>30+ Jersey</p>
                <a href="{{route('colections')}}" class="category-button">Lihat Semua</a>
            </div>
        </div>
    </div>
</div>

<div class="newsletter-section">
    <div class="newsletter-content">
        <h2>Berlangganan Newsletter</h2>
        <p>Dapatkan info terbaru dan diskon eksklusif</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Masukkan email Anda">
            <button type="submit">Subscribe</button>
        </form>
    </div>
</div>
@endsection