{{-- resources/views/admin/products/show.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Detail Produk')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/detail_produk.css') }}">
@endpush

@section('content')
<div class="product-detail">
    <div class="product-header">
        <h1>Detail Produk</h1>
    </div>

    <div class="product-info">
        <h2 class="product-name">{{ $product->name }}</h2>

        <div class="info-grid">
            <div class="info-item">
                <span class="label">Kategori:</span>
                <span class="value">{{ $product->category->name }}</span>
            </div>

            <div class="info-item">
                <span class="label">Harga:</span>
                <span class="value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>

            <div class="info-item">
                <span class="label">Stok:</span>
                <span class="value">{{ $product->stock }}</span>
            </div>

            <div class="info-item full-width">
                <span class="label">Deskripsi:</span>
                <span class="value">{{ $product->description }}</span>
            </div>
        </div>

        <div class="features-section">
            <h3>Fitur Produk:</h3>
            <div class="features-list">
                @php
                    $features = json_decode($product->features);
                @endphp
                
                @if(is_array($features))
                    <ul>
                    @foreach($features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                    </ul>
                @else
                    <p class="no-data">Tidak ada fitur tersedia</p>
                @endif
            </div>
        </div>

        <div class="product-images">
            <h3>Gambar Produk</h3>
            
            <!-- Gambar Utama Produk -->
            <div class="main-image">
                <img src="{{ asset('storage/' . $product->image_main) }}" alt="Gambar Produk Utama" class="main-product-image">
            </div>

            <div class="image-gallery">
                @php
                    $thumbnails = json_decode($product->image_thumbnails);
                @endphp
                
                @if(is_array($thumbnails) && !empty($thumbnails))
                    @foreach($thumbnails as $thumbnail)
                        <div class="image-item">
                            <img src="{{ asset('storage/' . $thumbnail) }}" alt="Product thumbnail" class="thumbnail">
                        </div>
                    @endforeach
                @else
                    <p class="no-data">Tidak ada gambar thumbnail tersedia</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
