<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar Header with Logo -->
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="/api/placeholder/60/60" alt="Logo" class="logo">
                <div class="logo-text">
                    <h2>Jersey Store</h2>
                    <span class="subtitle">Admin Panel</span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <div class="nav-section">
                <h3 class="nav-title">MAIN MENU</h3>
                <ul>
                    <li class="nav-item active">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                            <span class="nav-indicator"></span>
                        </a>
                    </li>
                    <li class="nav-item has-submenu">
                        <a href="#" class="submenu-toggle">
                            <i class="fas fa-tshirt"></i>
                            <span>Produk</span>
                            <i class="fas fa-chevron-down submenu-indicator"></i>
                            
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('produk.view.add')}}">Tambah Produk</a></li>
                            <li><a href="{{route('produk.view')}}">Daftar Produk</a></li>
                            <li><a href="{{route('kategori.view')}}">Kategori</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#orders">
                            
                            <span>Pesanan</span>
                            <div class="item-badge warning">25</div>
                        </a>
                    </li> --}}
                    <li class="nav-item has-submenu">
                        <a href="#" class="submenu-toggle">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesanan</span>
                            <i class="fas fa-chevron-down submenu-indicator"></i>
                            
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('transaksi.view.admin')}}">Data Pesanan</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Rest of the navigation remains the same -->
            <div class="nav-section">
                <h3 class="nav-title">MANAJEMEN</h3>
                <ul>
                    <li class="nav-item has-submenu">
                        <a href="#" class="submenu-toggle">
                            <i class="fas fa-users"></i>
                            <span>Pengguna</span>
                            <i class="fas fa-chevron-down submenu-indicator"></i>
                            
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('customer.view')}}">Data Pelanggan</a></li>
                            
                           
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('laporan.keuangan')}}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <h3 class="nav-title">PENGATURAN</h3>
                <ul>
                    {{-- <li class="nav-item">
                        <a href="#profile">
                            <i class="fas fa-user-circle"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                    <!-- Form Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </nav>

        <!-- User Profile Section -->
        <div class="sidebar-footer">
            <div class="user-profile">
                <img src="/api/placeholder/48/48" alt="Admin Profile" class="profile-img">
                <div class="user-info">
                    <h4>Alex Mitchell</h4>
                    <span class="user-role">Super Admin</span>
                </div>
                <button class="profile-menu-btn">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle submenu
        document.addEventListener('DOMContentLoaded', function() {
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
            
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.parentElement;
                    parent.classList.toggle('submenu-active');
                    
                    // Rotate chevron icon
                    const chevron = this.querySelector('.submenu-indicator');
                    chevron.style.transform = parent.classList.contains('submenu-active') 
                        ? 'rotate(180deg)' 
                        : 'rotate(0)';
                });
            });
        });
    </script>
</body>
</html>