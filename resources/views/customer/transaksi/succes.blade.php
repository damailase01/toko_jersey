<!-- resources/views/order/success.blade.php -->
<h2>Pesanan Berhasil!</h2>
<p>Pesanan Anda telah berhasil disimpan.</p>
<p>Detail Pesanan:</p>
<ul>
    <li>Nama Produk: {{ $order->product->name }}</li>
    <li>Ukuran: {{ $order->size }}</li>
    <li>Jumlah: {{ $order->quantity }}</li>
    <li>Harga Satuan: Rp {{ number_format($order->price, 0, ',', '.') }}</li>
    <li>Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</li>
    <li>Ongkos Kirim: Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</li>
    <li>Alamat Pengiriman: {{ $order->address }}</li>
    <li>Kota: {{ $order->city }}</li>
    <li>Kurir: {{ $order->courier }}</li>
    <li>Metode Pembayaran: {{ $order->payment_method }}</li>
</ul>
