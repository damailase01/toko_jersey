@extends('layouts.admin.app')

@section('title', 'Tambah Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h2>Edit Produk</h2>
            <div class="date-today">Perbarui informasi produk yang ada</div>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT') <!-- Tambahkan method PUT -->
            
            <div class="form-header">
                <div class="header-wrapper">
                    <h3>Form Edit Produk</h3>
                    <p class="subtitle">Perbarui informasi detail produk</p>
                </div>
            </div>
        
            <div class="form-body">
                <!-- Nama Produk -->
                <div class="form-group">
                    <label for="name">Nama Produk <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-box"></i>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input @error('name') is-invalid @enderror"
                               placeholder="Masukkan nama produk"
                               value="{{ old('name', $product->name) }}" <!-- Ambil data produk -->
                               
                    </div>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Kategori -->
                <div class="form-group">
                    <label for="category_id">Kategori <span class="required">*</span></label>
                    <div class="select-wrapper">
                        <select name="category_id" 
                                id="category_id" 
                                class="form-input @error('category_id') is-invalid @enderror" 
                                required>
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Harga -->
                <div class="form-group">
                    <label for="price">Harga <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-tag"></i>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               class="form-input @error('price') is-invalid @enderror"
                               placeholder="Masukkan harga produk"
                               value="{{ old('price', $product->price) }}"
                               step="0.01"
                               required>
                    </div>
                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Stok -->
                <div class="form-group">
                    <label for="stock">Stok <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-warehouse"></i>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               class="form-input @error('stock') is-invalid @enderror"
                               placeholder="Masukkan jumlah stok"
                               value="{{ old('stock', $product->stock) }}"
                               required>
                    </div>
                    @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea id="description" 
                              name="description" 
                              class="form-input @error('description') is-invalid @enderror"
                              placeholder="Masukkan deskripsi produk">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Gambar Utama -->
                <div class="form-group">
                    <label for="image_main">Foto Produk Utama</label>
                    <input type="file" 
                           id="image_main" 
                           name="image_main" 
                           accept="image/*" 
                           class="@error('image_main') is-invalid @enderror"
                           style="display: none;">
                    <div class="image-preview" onclick="document.getElementById('image_main').click()">
                        @if($product->image_main)
                            <img src="{{ asset('storage/' . $product->image_main) }}" 
                                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        @else
                            <i class="fas fa-camera"></i>
                        @endif
                    </div>
                    @error('image_main')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        
            <div class="form-footer">
                <a href="{{ route('produk.view') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Perbarui Produk
                </button>
            </div>
        </form>
        
    </div>
</div>

@push('scripts')
<script>
    // Add Feature
    function addFeature() {
        const featuresList = document.getElementById('featuresList');
        const featureItem = document.createElement('div');
        featureItem.className = 'feature-item';
        featureItem.innerHTML = `
            <input type="text" name="features[]" class="form-input" placeholder="Masukkan fitur produk">
            <button type="button" class="btn-remove-feature" onclick="removeFeature(this)">
                <i class="fas fa-times"></i>
            </button>
        `;
        featuresList.appendChild(featureItem);
    }

    // Remove Feature
    function removeFeature(button) {
        button.parentElement.remove();
    }

    // Preview Main Image
    document.getElementById('image_main').addEventListener('change', function(e) {
        const preview = this.nextElementSibling;
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%; object-fit: contain;">`;
            }
            reader.readAsDataURL(file);
        }
    });

    // Preview Thumbnails
    document.getElementById('image_thumbnails').addEventListener('change', function(e) {
        const container = document.querySelector('.thumbnail-container');
        const files = e.target.files;

        // Clear existing previews except the add button
        while (container.children.length > 1) {
            container.removeChild(container.firstChild);
        }

        // Add new previews
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            const preview = document.createElement('div');
            preview.className = 'thumbnail-preview';

            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%; object-fit: contain;">`;
            }
            reader.readAsDataURL(file);
            container.insertBefore(preview, container.lastElementChild);
        });
    });
</script>
@endpush
@endsection