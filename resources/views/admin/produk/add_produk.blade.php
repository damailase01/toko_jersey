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
            <h2>Tambah Produk</h2>
            <div class="date-today">Tambahkan produk baru ke katalog Anda</div>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            <div class="form-header">
                <div class="header-wrapper">
                    <h3>Form Produk Baru</h3>
                    <p class="subtitle">Isi informasi detail produk</p>
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
                               value="{{ old('name') }}"
                               required>
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
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                               value="{{ old('price') }}"
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
                               value="{{ old('stock') }}"
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
                              placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar Utama -->
                <div class="form-group">
                    <label for="image_main">Foto Produk Utama <span class="required">*</span></label>
                    <input type="file" 
                           id="image_main" 
                           name="image_main" 
                           accept="image/*" 
                           class="@error('image_main') is-invalid @enderror"
                           style="display: none;"
                           required>
                    <div class="image-preview" onclick="document.getElementById('image_main').click()">
                        <i class="fas fa-camera"></i>
                    </div>
                    @error('image_main')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Thumbnail Images -->
                <div class="form-group">
                    <label for="image_thumbnails">Foto Thumbnail</label>
                    <input type="file" 
                           id="image_thumbnails" 
                           name="image_thumbnails[]" 
                           accept="image/*" 
                           multiple 
                           class="@error('image_thumbnails') is-invalid @enderror"
                           style="display: none;">
                    <div class="thumbnail-container">
                        <div class="thumbnail-preview" onclick="document.getElementById('image_thumbnails').click()">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                    @error('image_thumbnails')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Features -->
                <div class="form-group">
                    <label>Fitur Produk</label>
                    <div class="features-list" id="featuresList">
                        <div class="feature-item">
                            <input type="text" 
                                   name="features[]" 
                                   class="form-input @error('features') is-invalid @enderror"
                                   placeholder="Masukkan fitur produk"
                                   value="{{ old('features.0') }}">
                            <button type="button" class="btn-remove-feature" onclick="removeFeature(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-add-feature" onclick="addFeature()">
                        <i class="fas fa-plus"></i>
                        Tambah Fitur
                    </button>
                    @error('features')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-footer">
                <a href="" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Produk
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