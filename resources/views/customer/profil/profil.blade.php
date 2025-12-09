@extends('layouts.app')

@section('title', 'Profil Saya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil/profil.css') }}">
@endpush

@section('content')
<div class="profile-page">
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="profile-sidebar">
            <div class="user-brief">
                <div class="user-avatar">
                    <img src="https://via.placeholder.com/80" alt="User Avatar">
                    <button class="edit-avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <div class="user-info">
                    <h3 class="username">John Doe</h3>
                    <span class="user-status">Member Silver</span>
                </div>
            </div>

            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-user"></i>
                    Profil Saya
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-map-marker-alt"></i>
                    Alamat
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-heart"></i>
                    Wishlist
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-history"></i>
                    Riwayat Pesanan
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-wallet"></i>
                    Pembayaran
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-star"></i>
                    Review Saya
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    Pengaturan
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="profile-content">
            <div class="content-header">
                <h2>Profil Saya</h2>
                <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
            </div>

            <div class="profile-form">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" value="johndoe123" readonly class="form-control">
                        <small>Username tidak dapat diubah</small>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" value="John Doe" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="verified-input">
                            <input type="email" value="john.doe@example.com" class="form-control">
                            <span class="verified-badge">Terverifikasi</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <div class="verified-input">
                            <input type="tel" value="+62 812-3456-7890" class="form-control">
                            <span class="verified-badge">Terverifikasi</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="male" checked>
                                <span>Laki-laki</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="female">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="date-inputs">
                            <select class="form-control">
                                <option>1</option>
                                <!-- Add more days -->
                            </select>
                            <select class="form-control">
                                <option>Januari</option>
                                <!-- Add more months -->
                            </select>
                            <select class="form-control">
                                <option>1990</option>
                                <!-- Add more years -->
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Simpan</button>
                    </div>
                </form>
            </div>

            <!-- Additional Information -->
            <div class="additional-info">
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Keamanan Akun</h3>
                    </div>
                    <div class="info-item">
                        <span>Status Verifikasi</span>
                        <span class="verified">Terverifikasi</span>
                    </div>
                    <div class="info-item">
                        <span>Login Terakhir</span>
                        <span>2 jam yang lalu</span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-award"></i>
                        <h3>Status Member</h3>
                    </div>
                    <div class="member-status">
                        <img src="https://via.placeholder.com/50" alt="Silver Badge">
                        <div class="member-details">
                            <h4>Member Silver</h4>
                            <p>Berbelanja 50rb lagi untuk upgrade ke Gold</p>
                            <div class="progress-bar">
                                <div class="progress" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection