<!-- header.blade.php -->

<head>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

    
<!-- header.blade.php -->
<header class="header">
    <nav class="navbar">
        <div class="container">
            <!-- Logo -->
            <a href="/" class="logo">
                Jersey<span>Store</span>
            </a>

            <!-- Main Navigation -->
            <ul class="nav-menu">
                <li><a href="/" class="active">Home</a></li>
                <li>
                    <a href="{{ route('colections') }}">Collections</a>
                </li>
                <li><a href="">New Arrival</a></li>
                <li><a href="">Sale</a></li>
            </ul>

            <!-- Right Navigation -->
            <div class="nav-right">
                <div class="search">
                    <input type="text" placeholder="Search...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="nav-icons">
                    <a href="{{route('cart')}}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                    <a href="{{ route('profil') }}" class="user-icon">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
                <div class="nav-right">
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-login">
                            Logout
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Login</a>
                    @endauth

                    <!-- Display flash message on logout -->
                    @if (session('status') == 'logged_out')
                        
                    @endif
                </div>
                

                <!-- Mobile Menu Button -->
                <button class="mobile-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>
</header>

    <script src="{{ asset('js/header.js') }}"></script>
    <script>
        window.addEventListener('load', function () {
    // Periksa apakah status logout ada di session
    if (sessionStorage.getItem('status') === 'logged_out') {
        // Jika logout, update tombol menjadi Login
        document.querySelector('.btn-login').innerText = 'Login';
        
        // Hapus status logout dari session storage agar tidak terus muncul setelah reload
        sessionStorage.removeItem('status');
    } else {
        // Jika sudah login, tombol tetap Logout
        if (document.querySelector('.btn-login').innerText !== 'Login') {
            document.querySelector('.btn-login').innerText = 'Logout';
        }
    }
});

    </script>
