@extends('layouts.app')

@section('title', 'Detail Jersey')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/produk/produk-detail.css') }}">
@endpush

@section('content')
<div class="product-detail">
    <div class="container">
        <div class="product-wrapper">
            <div class="product-content">
                <!-- Left Side - Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <img src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" id="mainImage">
                    </div>
                    <div class="thumbnail-images">
                        @foreach (json_decode($product->image_thumbnails, true) as $thumbnail)
                        <div class="thumb" onclick="changeMainImage('{{ asset('storage/' . $thumbnail) }}')">
                            <img src="{{ asset('storage/' . $thumbnail) }}" alt="Thumbnail">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Side - Product Info -->
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-meta">
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-count">(150 ulasan)</span>
                        </div>
                        <div class="sold">1.2k terjual</div>
                    </div>

                    <div class="product-price">
                        <span class="current-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="original-price">Rp 999.000</span>
                        <span class="discount-badge">-10%</span>
                    </div>

                    <div class="product-variants">
                        <h3>Pilih Ukuran</h3>
                        <div class="size-options">
                            <button class="size-btn" data-size="S">S</button>
                            <button class="size-btn" data-size="M">M</button>
                            <button class="size-btn" data-size="L">L</button>
                            <button class="size-btn" data-size="XL">XL</button>
                        </div>
                    </div>

                    <div class="product-quantity">
                        <h3>Jumlah</h3>
                        <div class="quantity-selector">
                            <button onclick="decrementQuantity()">-</button>
                            <input type="number" id="quantity" value="1" min="1" max="10">
                            <button onclick="incrementQuantity()">+</button>
                        </div>
                        <span class="stock-info">Stok: {{ $product->stock }}</span>
                    </div>

                    <div class="action-buttons">
                        <button class="add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Tambah ke Keranjang
                        </button>
                        <form action="{{ route('detail-order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="size" id="selectedSize" value="">
                            <input type="hidden" name="quantity" id="selectedQuantity" value="1">
                            <button type="submit" class="buy-now-btn">Beli Sekarang</button>
                        </form>
                        
                        
                    </div>

                    <div class="product-description">
                        <div class="description-tabs">
                            <button class="tab-btn active" data-tab="detail">Detail Produk</button>
                            <button class="tab-btn" data-tab="info">Informasi Produk</button>
                            <button class="tab-btn" data-tab="size">Panduan Ukuran</button>
                        </div>

                        <!-- Tab Detail Produk -->
                        <div class="tab-content active" id="detail">
                            <div class="content-box">
                                <div class="detail-grid">
                                    <div class="detail-item">
                                        <span class="label">Kondisi</span>
                                        <span class="value">Baru</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="label">Min. Pemesanan</span>
                                        <span class="value">1 Buah</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="label">Kategori</span>
                                        <span class="value">{{ $product->category->name }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="label">Etalase</span>
                                        <span class="value">Toko Kami</span>
                                    </div>
                                </div>

                                <div class="description-text">
                                    <p>{{ $product->description }}</p>
                                    
                                    <div class="feature-list">
                                        <h4>Keunggulan Produk:</h4>
                                        <ul>
                                            @foreach (json_decode($product->features, true) as $feature)
                                            <li>✅ {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Informasi Produk -->
                        <div class="tab-content" id="info">
                            <div class="content-box">
                                <div class="info-list">
                                    <div class="info-item">
                                        <div class="info-title">Material</div>
                                        <div class="info-value">100% Polyester Daur Ulang</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Jenis Jersey</div>
                                        <div class="info-value">Replica Version</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Season</div>
                                        <div class="info-value">2023/24</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Teknologi</div>
                                        <div class="info-value">AEROREADY</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Logo</div>
                                        <div class="info-value">Bordir</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Sponsor</div>
                                        <div class="info-value">Heat Transfer</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Berat</div>
                                        <div class="info-value">250 gram</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-title">Dikirim dari</div>
                                        <div class="info-value">MEDAN</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Panduan Ukuran -->
                        <div class="tab-content" id="size">
                            <div class="content-box">
                                <div class="size-chart">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Ukuran</th>
                                                <th>Lebar Dada</th>
                                                <th>Panjang Baju</th>
                                                <th>Cocok untuk BB</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>S</td>
                                                <td>50 cm</td>
                                                <td>70 cm</td>
                                                <td>50-60 kg</td>
                                            </tr>
                                            <tr>
                                                <td>M</td>
                                                <td>52 cm</td>
                                                <td>72 cm</td>
                                                <td>60-70 kg</td>
                                            </tr>
                                            <tr>
                                                <td>L</td>
                                                <td>54 cm</td>
                                                <td>74 cm</td>
                                                <td>70-80 kg</td>
                                            </tr>
                                            <tr>
                                                <td>XL</td>
                                                <td>56 cm</td>
                                                <td>76 cm</td>
                                                <td>80-90 kg</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="size-note">
                                        <p>⚠️ Catatan Ukuran:</p>
                                        <ul>
                                            <li>Toleransi ukuran 1-2 cm</li>
                                            <li>Pilih ukuran yang lebih besar jika BB berada di batas atas</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.size-btn').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('selectedSize').value = this.dataset.size;
    });
});

document.getElementById('quantity').addEventListener('input', function () {
    document.getElementById('selectedQuantity').value = this.value;
});

</script>
<script src="{{asset('js/produk/produk-detail.js')}}"></script>
@endpush