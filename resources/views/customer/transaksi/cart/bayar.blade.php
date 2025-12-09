@extends('layouts.app')

@section('title', 'Toko Jersey')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/transaksi/bayar.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush


@section('content')
<div class="container">
    <div class="page-header">
        <h1>Pembayaran</h1>
        <p class="subtitle">Selesaikan pembayaran Anda untuk memproses pesanan</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Order Details -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Detail Pesanan #ORD{{ $order->id }}</div>
                <div class="status-badge">Menunggu Pembayaran</div>
            </div>

            <div class="order-info">
                <div class="info-grid">
                    <div class="info-item">
                        <h4>Tanggal Pesanan</h4>
                        <p>
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div class="info-item">
                        <h4>Metode Pengiriman</h4>
                        @if ($order->courier == 'jne')
                            <p>JNE Regular (2-3 hari)</p>
                        @elseif ($order->courier == 'tiki')
                            <p>TIKI Express (1-2 hari)</p>
                        @elseif ($order->courier == 'pos')
                            <p>POS Indonesia (3-5 hari)</p>
                        @else
                            <p>Metode pengiriman tidak diketahui</p>
                        @endif
                    </div>
                    <div class="info-item">
                        <h4>Alamat Pengiriman</h4>
                        <p>{{$order->address}}, {{$order->city}}</p>
                    </div>
                </div>
            </div>

            <div class="items-list">
                <div class="item">
                    <div class="item-image">
                        <img src="{{ asset('storage/' . $order->product->image_main) }}" alt="{{ $order->product->name }}">
                    </div>
                    <div class="item-details">
                        <div class="item-name">
                            {{ $order->product->name }}
                        </div>
                        <div class="item-meta">
                            Ukuran: {{ $order->size }} • Quantity: {{ $order->quantity }}
                        </div>
                        <div class="item-price">
                            Rp {{ number_format($order->price * $order->quantity , 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Instruksi Pembayaran</div>
            </div>
            <div class="bank-accounts">
                @if ($order->payment_method == 'bca')
                    <div class="bank-name">Bank BCA</div>
                    <div class="account-number">8735261904</div>
                    <div class="account-holder">a.n. PT Jersey Store Indonesia</div>
                @elseif ($order->payment_method == 'bsi')
                    <div class="bank-name">Bank BSI</div>
                    <div class="account-number">7196527893</div>
                    <div class="account-holder">a.n. PT Jersey Store Indonesia</div>
                @endif
            </div>
        </div>

        <form action="{{ route('payment.confirm', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Upload Bukti Transfer</div>
                </div>
                <div class="upload-section">
                    <div class="upload-area" onclick="document.getElementById('payment_proof').click()">
                        <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="file-input" style="display:none" onchange="previewFile()">
                        <div class="upload-icon">↑</div>
                        <div class="upload-text">Upload Bukti Pembayaran Anda</div>
                        <div class="upload-hint">Klik atau seret file ke area ini</div>
                        <div id="file-name" class="file-name"></div>
                        <img id="preview" src="" alt="Preview" style="display:none; max-width: 100%; margin-top: 15px;">
                    </div>
                    
                    <div class="requirements">
                        <ul>
                            <li>Format yang didukung: JPG atau PNG</li>
                            <li>Ukuran maksimal file: 2MB</li>
                            <li>Pastikan bukti transfer terlihat jelas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
            <!-- Payment Summary -->
            <div class="payment-summary">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ringkasan Pembayaran</div>
                    </div>
                    <div class="summary-list">
                        <div class="summary-item">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($order->price * $order->quantity, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rp {{ number_format(($order->price * $order->quantity) + $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="timer">
                            <span class="timer-icon">⏰</span>
                            <span>Bayar dalam 23:45:30</span>
                        </div>
                        <button class="btn btn-primary" type="submit">Konfirmasi Pembayaran</button>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection

@push('scripts')
<script>
function previewFile() {
    const fileInput = document.getElementById('payment_proof');
    const preview = document.getElementById('preview');
    const uploadArea = document.getElementById('upload-area');
    const uploadContent = document.querySelector('.upload-content');
    const fileNameDisplay = document.getElementById('file-name');
    const file = fileInput.files[0];

    if (file) {
        // Menampilkan nama file
        fileNameDisplay.textContent = "File Terpilih: " + file.name;

        // Menampilkan gambar yang dipilih
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block"; // Menampilkan gambar

            // Mengubah area upload menjadi gambar
            uploadArea.style.backgroundImage = `url(${e.target.result})`;
            uploadArea.style.backgroundSize = 'cover';
            uploadArea.style.backgroundPosition = 'center';
            uploadArea.style.border = 'none'; // Hilangkan border
            uploadArea.style.padding = '0'; // Hapus padding untuk menyesuaikan gambar

            // Sembunyikan elemen teks dan ikon setelah foto dipilih
            uploadContent.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}


</script>

@endpush