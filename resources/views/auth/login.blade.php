<!-- login.html -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jersey Store</title>
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="form-container">
                <h1>Selamat Datang</h1>
                <p class="subtitle">Silakan login untuk melanjutkan</p>
                
                <form class="login-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email -->
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <!-- Tampilkan Pesan Error jika Ada -->
                    @if ($errors->any())
                        <div class="error-message">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox">
                            Ingat saya
                        </label>
                        <a href="#">Lupa password?</a>
                    </div>

                    <button type="submit">Login</button>
                </form>
                
                <div class="divider">
                    <span>atau</span>
                </div>
                
                <div class="social-login">
                    <button class="google-btn">
                        <i class="fab fa-google"></i>
                        Login dengan Google
                    </button>
                </div>
                
                <p class="register-link">
                    Belum punya akun? <a href="{{route('register')}}">Daftar sekarang</a>
                </p>
            </div>
            
            <div class="image-container">
                <div class="overlay"></div>
            </div>
        </div>
    </div>
</body>
</html>