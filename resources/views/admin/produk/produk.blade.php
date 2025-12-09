@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h2>Produk</h2>
            <div class="date-today">Kelola produk Anda</div>
        </div>
        <div class="header-right">
            <div class="stats-card">
                <i class="fas fa-box"></i>
                <div class="stats-info">
                    <span class="stats-label">Total Produk</span>
                    <span class="stats-value">{{ $products->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="product-container">
        <div class="product-header">
            <div class="header-wrapper">
                <h3>Daftar Produk</h3>
                <p class="subtitle">Manajemen data produk</p>
            </div>
            <div class="header-actions">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari produk..." class="search-input">
                </div>
                <a href="{{ route('produk.view.add') }}" class="add-product-btn" style="text-decoration: none;">
                    Tambah Produk
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>
                            <div class="th-content">
                                <span>No</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Gambar Utama</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Nama Produk</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Kategori</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Harga</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        
                        
                        <th class="action-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                    <tr>
                        <td>
                            <span class="id-badge">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $product->image_main) }}" alt="Product Image" width="100">
                        </td>
                        <td>
                            <div class="product-name">
                                <span>{{ $product->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="category-name">{{ $product->category->name }}</span>
                        </td>
                        <td>
                            <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>
                        
                        
                        
                        <td>
                            <div class="action-buttons">
                                <button class="table-action-btn view-btn" title="Lihat Detail" onclick="window.location.href='{{ route('produk.detail.admin', $product->id) }}'">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="table-action-btn edit-btn" title="Edit" onclick="window.location.href='{{route('produk.edit', $product->id) }}'">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('produk.delete', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action-btn delete-btn" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

        <div class="table-footer">
            <div class="showing-entries">
                Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} dari {{ $products->total() }} data
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- Modal untuk Detail Produk -->
</div>

@endsection
@push('scripts')
function showProductDetails(url) {
    try {
        // Tampilkan modal atau lakukan redirect ke halaman detail produk
        window.location.href = url;
    } catch (error) {
        console.error('Error:', error);
        alert('Maaf, terjadi kesalahan saat memuat detail produk. Silakan coba lagi.');
    }
}
@endpush


