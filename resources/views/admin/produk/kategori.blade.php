@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/kategori.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h2>Kategori</h2>
            <div class="date-today">Kelola kategori produk Anda</div>
        </div>
        <div class="header-right">
            <div class="stats-card">
                <i class="fas fa-layer-group"></i>
                <div class="stats-info">
                    <span class="stats-label">Total Kategori</span>
                    <span class="stats-value">{{ $categories->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="category-container">
        <div class="category-header">
            <div class="header-wrapper">
                <h3>Daftar Kategori</h3>
                <p class="subtitle">Manajemen data kategori produk</p>
            </div>
            <div class="header-actions">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kategori..." class="search-input">
                </div>
                <a href="{{ route('kategori.view.add') }}" class="add-category-btn" style="text-decoration: none;">
                    
                    Tambah Kategori
                </a>
                
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="category-table">
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
                                <span>Nama Kategori</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Total Produk</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th class="action-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                    <tr>
                        <td>
                            <span class="id-badge">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="category-name">
                                <span>{{ $category->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="product-count">{{ $category->products->count() }} Produk</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="table-action-btn edit-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('kategori.delete', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                Menampilkan 1 sampai 2 dari 2 data
            </div>
            <div class="pagination">
                <button class="page-btn disabled">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection