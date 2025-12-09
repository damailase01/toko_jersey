<!-- register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Jersey Store</title>
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    

    <div class="container">
        <div class="register-container">
            <div class="form-container">
                <h1>Buat Akun Baru</h1>
                <p class="subtitle">Bergabung dengan Jersey Store</p>
                
                <form action="{{ route('register') }}" method="POST" class="register-form">
                    @csrf

                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="input-group">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone_number" placeholder="Nomor Telepon" required value="{{ old('phone_number') }}">
                        @if ($errors->has('phone_number'))
                            <div class="error">{{ $errors->first('phone_number') }}</div>
                        @endif
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="terms">
                        <label>
                            <input type="checkbox" required>
                            Saya setuju dengan <a href="#">Syarat dan Ketentuan</a>
                        </label>
                    </div>
                    
                    <button type="submit">Daftar Sekarang</button>
                </form>
                
                <div class="divider">
                    <span>atau</span>
                </div>
                
                <div class="social-register">
                    <button class="google-btn">
                        <i class="fab fa-google"></i>
                        Daftar dengan Google
                    </button>
                </div>
                
                <p class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </p>
            </div>
            
            <div class="image-container">
                <div class="overlay"></div>
            </div>
        </div>
    </div>
</body>
</html>
