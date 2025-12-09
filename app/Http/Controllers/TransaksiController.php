<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class TransaksiController extends Controller
{
    public function transaksi_view_admin()
    {
        $pendingOrders = Order::where('status', 'pending')->get();
        $processOrders = Order::where('status', 'process')->get();
        $completeOrders = Order::where('status', 'success')->get();
        $waitingOrders = Order::where('status', 'unpaid')->get();

                // Mengambil pesanan berdasarkan status
        $pendingOrders = Order::where('status', 'pending')->get();
        $processOrders = Order::where('status', 'process')->get();
        $successOrders = Order::where('status', 'success')->get();
        $unpaidOrders = Order::where('status', 'unpaid')->get();

        // Menghitung total pesanan berdasarkan status
        $pendingCount = $pendingOrders->count();
        $processCount = $processOrders->count();
        $successCount = $successOrders->count();
        $unpaidCount = $unpaidOrders->count();
        return view('admin.pesanan.pesanan', compact('pendingOrders', 'processOrders', 'completeOrders', 'waitingOrders', 'pendingCount', 'processCount', 'successCount', 'unpaidCount'));
    }

    public function transaksi_detail_admin($id)
    {
        // Ambil data transaksi berdasarkan ID
        $order = Order::with(['user', 'product'])->findOrFail($id);

        // Kirim data ke view
        return view('admin.pesanan.detail_pesanan', compact('order'));
    }



    public function detailOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $size = $validated['size'];
        $quantity = $validated['quantity'];
        $user = Auth::user();

        return view('customer.transaksi.detail-order', compact('product', 'size', 'quantity', 'user'));
    }

    public function processOrder(Order $order)
    {

        // Update status order menjadi "process"
        $order->status = 'process'; // pastikan status field ada di tabel orders
        $order->save();

        return redirect()->route('transaksi.view.admin')->with('success', 'Pesanan berhasil diproses.');
    }

    public function orderstore(Request $request)

{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'size' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'address' => 'required|string',
        'city' => 'required|string',
        'courier' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    // Mendapatkan informasi produk, user, dan lainnya
    $product = Product::findOrFail($validated['product_id']);
    $user = Auth::user();

    // Menyimpan pesanan ke dalam tabel orders
    $order = new Order();
    $order->user_id = $user->id;
    $order->product_id = $product->id;
    $order->size = $validated['size'];
    $order->quantity = $validated['quantity'];
    $order->address = $validated['address'];
    $order->city = $validated['city'];
    $order->courier = $validated['courier'];
    $order->payment_method = $validated['payment_method'];
    $order->price = $product->price;
    $order->shipping_cost = 25000; // Pastikan kolom shipping_cost diisi
    $order->total_price = ($product->price * $validated['quantity']) + 25000; // Total harga
    $order->status = 'unpaid'; // Status pesanan
    $order->save();

    // Redirect ke halaman konfirmasi atau detail pesanan
    return redirect()->route('cart', ['order' => $order->id]);
}

    
    public function success()
    {
        $order = Order::where('user_id', Auth::id())->latest()->first(); // Ambil pesanan terbaru
        return view('customer.transaksi.succes', compact('order'));
    }

    public function cart()
    {
        $customerId = Auth::id(); // Pastikan pelanggan sedang login

        // Ambil data pesanan berdasarkan status
        $orders = [
            'unpaid' => Order::where('user_id', $customerId)->where('status', 'unpaid')->get(),
            'pending' => Order::where('user_id', $customerId)->where('status', 'pending')->get(),
            'process' => Order::where('user_id', $customerId)->where('status', 'process')->get(),
            'success' => Order::where('user_id', $customerId)->where('status', 'success')->get(),
        ];
        return view('customer.transaksi.cart.proses',compact('orders'));
    }

    public function showPaymentPage(Order $order)
    {
        // Pastikan order ada dan milik user yang terautentikasi
        if (!$order || $order->user_id !== auth()->id()) {
            return redirect()->route('orders.index')->with('error', 'Pesanan tidak ditemukan.');
        }
    
        // Eager load 'products' untuk mendapatkan produk terkait
        $order->load('product');

        return view('customer.transaksi.cart.bayar', compact('order'));
    }

    public function confirmPayment(Request $request, $id)
{
    // Validasi file yang diunggah
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', // Maksimal 2MB
    ]);

    // Ambil order berdasarkan ID
    $order = Order::findOrFail($id);

    // Ambil file yang diunggah
    $file = $request->file('payment_proof');

    // Simpan file ke storage dengan nama unik
    $filePath = $file->storeAs('public/payment_proofs', uniqid() . '.' . $file->getClientOriginalExtension());

    // Update status order menjadi "pending" dan simpan bukti pembayaran
    $order->payment_proof = $filePath;
    $order->status = 'pending';  // Set status menjadi pending
    $order->save();

    // Ambil produk yang dipesan (hanya satu produk)
    $product = $order->product; // Pastikan ada relasi 'product' pada model Order

    // Ambil quantity yang dipesan
    $quantityOrdered = $order->quantity;

    // Kurangi stok produk sesuai dengan quantity yang dipesan
    $product->stock -= $quantityOrdered;

    // Simpan perubahan stok ke database
    $product->save();

    // Redirect ke halaman sukses atau halaman detail order
    return redirect()->route('cart')
                     ->with('success', 'Bukti pembayaran berhasil diunggah dan status order diperbarui. Stok produk telah diperbarui.');
}

    public function SuccesOrder(Order $order)
    {
        // Update status order menjadi "success"
        $order->status = 'success'; // pastikan status field ada di tabel orders
        $order->save();

        return redirect()->route('cart')->with('success', 'Pesanan berhasil diselesaikan.');
    }

    public function showPendingPage(Order $order)
    {
        // Pastikan order ada dan milik user yang terautentikasi
        
    
        // Eager load 'products' untuk mendapatkan produk terkait
        $order->load('product');

        return view('customer.transaksi.cart.pending', compact('order'));
    }






}
