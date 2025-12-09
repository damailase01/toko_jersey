<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Product::where('stock', '>', 0)->get();
    return view('index', compact('products'));
});




//AUTH
    //Login
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    //registrasi
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register']);


// Routes untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    //DASHBOARD
        Route::get('dashboard/admin', [AdminController::class, 'ShowDashboard'])->name('admin.dashboard');

    //PRODUK
        //kategori
        Route::get('kategori/view', [ProdukController::class, 'kategori_view'])->name('kategori.view');
        Route::get('kategori/view/add', [ProdukController::class, 'kategori_view_add'])->name('kategori.view.add');
        Route::post('kategori/store', [ProdukController::class, 'kategori_store'])->name('kategori.store');
        Route::delete('kategori/{id}/delete', [ProdukController::class, 'kategori_delete'])->name('kategori.delete');

        //produk
        Route::get('produk/view', [ProdukController::class, 'produk_view'])->name('produk.view');
        Route::get('produk/view/add', [ProdukController::class, 'produk_view_add'])->name('produk.view.add');
        Route::post('produk/store', [ProdukController::class, 'produk_store'])->name('produk.store');
        Route::get('/produk/{id}/edit', [ProdukController::class, 'produk_edit'])->name('produk.edit');
        Route::put('/produk/{id}/pos', [ProdukController::class, 'produk_update'])->name('produk.update');
        Route::get('/produk/detail/{id}/admin', [ProdukController::class, 'produk_detail'])->name('produk.detail.admin');
        Route::delete('produk/{id}/delete', [ProdukController::class, 'produk_delete'])->name('produk.delete');
    
    //TRANSAKSI/pesanan
        Route::get('transaksi/view/admin', [TransaksiController::class, 'transaksi_view_admin'])->name('transaksi.view.admin');
        Route::get('transaksi/{id}/detail/admin', [TransaksiController::class, 'transaksi_detail_admin'])->name('transaksi.detail.admin');
        Route::put('transaksi/{id}/update/admin', [TransaksiController::class, 'transaksi_update_admin'])->name('transaksi.update');
        Route::post('/order/{order}/process', [TransaksiController::class, 'processOrder'])->name('order.process');

        Route::delete('transaksi/{id}/delete', [TransaksiController::class, 'transaksi_delete'])->name('transaksi.delete');
    
    //CUSTOMER
        //customer
        Route::get('customer/view', [CustomerController::class, 'customer_view'])->name('customer.view');
        Route::delete('customer/{id}/delete', [CustomerController::class, 'customer_delete'])->name('customer.delete');
    
    //LAPORAN
        //keuangan
        Route::get('laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');


    // LOGOUT Route
        // Route::post('logout', function () {
        //     Auth::logout();
        //     session()->invalidate();
        //     session()->regenerateToken();

        //     // Mengarahkan ke halaman utama dengan status logout
        //     return redirect('/')->with('status', 'logged_out');
        // })->name('logout');


   
});

// Routes untuk Customer
Route::middleware(['auth', 'customer'])->group(function () {
    //DASHBOARD
        Route::get('dashboard', [CustomerController::class, 'index'])->name('customer.dashboard')->middleware('auth');

    //PRODUK
        Route::get('/produk/detail/{id}', [ProdukController::class, 'detail_produk_customer'])->name('produk.detail');
    


    //TRANSAKSI
        Route::post('/detail-order', [TransaksiController::class, 'detailOrder'])->name('detail-order');
        
        Route::post('/order/store', [TransaksiController::class, 'orderstore'])->name('order.store');

        Route::get('/order/success', [TransaksiController::class, 'success'])->name('order.success');
    
    //CART
        Route::get('/cart', [TransaksiController::class, 'cart'])->name('cart') ->middleware('auth');
        Route::get('/bayar-sekarang/{order}', [TransaksiController::class, 'showPaymentPage'])->name('bayar-sekarang');
        Route::post('/bayar/{id}/confirm-payment', [TransaksiController::class, 'confirmPayment'])->name('payment.confirm');
        Route::get('/pending/{order}', [TransaksiController::class, 'showPendingPage'])->name('pending.page');
        Route::post('/order/{order}/selesai', [TransaksiController::class, 'SuccesOrder'])->name('order.succes');
        
        Route::get('/api/products', [ProdukController::class, 'getProducts']);

    




        Route::get('/colections', function () {
            $products = Product::all();
            return view('colections', compact('products'));
        })->name('colections');
        
        Route::get('/profil', function () {
            return view('customer.profil.profil');
        })->name('profil');
        
        
        // LOGOUT Route

    
});


Route::post('logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    // Mengarahkan ke halaman utama dengan status logout
    return redirect('/')->with('status', 'logged_out');
})->name('logout');
