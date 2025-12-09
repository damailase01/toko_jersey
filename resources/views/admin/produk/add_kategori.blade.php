@extends('layouts.admin.app')

@section('title', 'Tambah Kategori')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/kategori.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h2>Tambah Kategori</h2>
            <div class="date-today">Tambahkan kategori baru untuk produk Anda</div>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('kategori.store') }}" method="POST" class="category-form">
            @csrf
            <div class="form-header">
                <div class="header-wrapper">
                    <h3>Form Kategori Baru</h3>
                    <p class="subtitle">Isi informasi kategori produk</p>
                </div>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-layer-group"></i>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input @error('nama_kategori') is-invalid @enderror"
                               placeholder="Masukkan nama kategori"
                               value="{{ old('nama_kategori') }}"
                               required>
                    </div>
                    @error('nama_kategori')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            

            <div class="form-footer">
                <a href="{{ route('kategori.view') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection