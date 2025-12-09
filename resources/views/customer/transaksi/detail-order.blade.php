@extends('layouts.app')

@section('title', 'Detail Pembelian')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/transaksi/detail-order.css') }}">
<style>
    .shipping-info {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        
        margin-bottom: 20px;
    }

    .shipping-info h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }

    .shipping-info h3 {
        font-size: 1.4rem;
        color: #444;
        margin-bottom: 10px;
    }

    .shipping-info .form-group {
        margin-bottom: 15px;
    }

    .shipping-info label {
        font-size: 1rem;
        color: #555;
        margin-bottom: 5px;
        display: block;
    }

    .shipping-info input,
    .shipping-info textarea,
    .shipping-info select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
        color: #333;
    }

    .shipping-info input:focus,
    .shipping-info textarea:focus,
    .shipping-info select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .shipping-info .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .shipping-info .btn-primary:hover {
        background-color: #0056b3;
    }

    .shipping-info .recipient,
    .shipping-info .phone {
        font-size: 1rem;
        color: #333;
        margin-bottom: 10px;
    }

    /* Shipping Method Section */
    .shipping-method {
        margin-top: 20px;
    }

    .shipping-method h3 {
        font-size: 1.4rem;
        color: #444;
        margin-bottom: 10px;
    }

    /* Payment Method Styling */
    .payment-method {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .payment-method h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }

    .payment-method .bank-transfer {
        margin-top: 20px;
    }

    .payment-method .bank-account {
        display: flex;
        align-items: center;
        background-color: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .payment-method .bank-account:hover {
        transform: scale(1.02);
    }

    .payment-method .bank-logo {
        max-width: 50px;
        margin-right: 15px;
    }

    .payment-method .account-info {
        flex-grow: 1;
    }

    .payment-method .account-info p {
        margin: 2px 0;
        font-size: 1rem;
        color: #555;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .action-buttons .btn-secondary,
    .action-buttons .btn-primary {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .action-buttons .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .action-buttons .btn-secondary:hover {
        background-color: #5a6268;
    }

    .action-buttons .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .action-buttons .btn-primary:hover {
        background-color: #0056b3;
    }
    /* Bank Transfer Container */
    .payment-method .bank-transfer {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-method .bank-account {
        display: flex;
        align-items: center;
        background-color: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    .payment-method .bank-account.active {
        border-color: #007bff;
        background-color: #e6f0ff;
    }

    .payment-method .bank-account:hover {
        border-color: #0056b3;
        background-color: #f0f8ff;
    }

    .payment-method .bank-logo {
        max-width: 50px;
        margin-right: 15px;
    }

    .payment-method .account-info {
        flex-grow: 1;
    }

    .payment-method .account-info p {
        margin: 2px 0;
        font-size: 1rem;
        color: #555;
    }

    /* Add hidden radio button */
    .payment-method .bank-account input[type="radio"] {
        display: none;
    }


</style>
@endpush

@section('content')
<div class="purchase-container">
    <div class="purchase-wrapper">
        <!-- Order Summary Section -->
        <div class="order-summary">
            <h2>Detail Pesanan</h2>
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" class="product-thumb">
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="variant">Ukuran: {{ $size }}</p>
                    <div class="price-info">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="quantity">x {{ $quantity }}</span>
                    </div>
                </div>
            </div>
            <div class="price-breakdown">
                <div class="price-row">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                </div>
                <div class="price-row">
                    <span>Ongkos Kirim</span>
                    <span>Rp 25.000</span>
                </div>
                <div class="price-row total">
                    <span>Total</span>
                    <span>Rp {{ number_format(($product->price * $quantity) + 25000, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Form for Order Submission -->
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="shipping-info">
                <h2>Informasi Pengiriman</h2>
                <div class="address-details">
                    <h3>Alamat Pengiriman</h3>
                    <p class="recipient"><strong>Nama Penerima:</strong> {{ $user->name }}</p>
                    <p class="phone"><strong>Nomor HP:</strong> {{ $user->phone_number }}</p>
                    <div class="form-group mt-3">
                        <label for="address">Alamat Lengkap</label>
                        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Masukkan kota" required>
                    </div>
                </div>
                <div class="shipping-method">
                    <h3>Metode Pengiriman</h3>
                    <div class="form-group">
                        <label for="courier">Pilih Kurir</label>
                        <select id="courier" name="courier" class="form-control" required>
                            <option value="jne">JNE Regular (2-3 hari) - Rp 25.000</option>
                            <option value="tiki">TIKI Express (1-2 hari) - Rp 30.000</option>
                            <option value="pos">POS Indonesia (3-5 hari) - Rp 20.000</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="payment-method">
                <h2>Metode Pembayaran</h2>
                <div class="bank-transfer">
                    <label class="bank-account active">
                        <input type="radio" name="payment_method" value="bca" required>
                        <img src="images/bca-logo.png" alt="BCA" class="bank-logo">
                        <div class="account-info">
                            <p class="bank-name">Bank BCA</p>
                            <p class="account-number">1234567890</p>
                            <p class="account-name">PT. Jersey Store Indonesia</p>
                        </div>
                    </label>
                    <label class="bank-account">
                        <input type="radio" name="payment_method" value="bsi" required>
                        <img src="images/bca-logo.png" alt="BSI" class="bank-logo">
                        <div class="account-info">
                            <p class="bank-name">Bank BSI</p>
                            <p class="account-number">1234567890</p>
                            <p class="account-name">PT. Jersey Store Indonesia</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Hidden Fields for Product Details -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="size" value="{{ $size }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="#" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const bankAccounts = document.querySelectorAll(".bank-account");

    bankAccounts.forEach((account) => {
        account.addEventListener("click", function () {
            // Hapus class 'active' dari semua elemen
            bankAccounts.forEach((item) => item.classList.remove("active"));

            // Tambahkan class 'active' ke elemen yang diklik
            this.classList.add("active");

            // Pilih input radio di dalam elemen yang diklik
            const radioInput = this.querySelector("input[type='radio']");
            if (radioInput) {
                radioInput.checked = true;
            }
        });
    });
});

</script>
@endpush
