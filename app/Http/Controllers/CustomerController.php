<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer_view()
    {
        // Ambil data users dengan role 'customer'
        $customers = User::where('role', 'customer')
        ->withCount('orders') // Menghitung jumlah pesanan
        ->paginate(10); // Pagination 10 data per halaman// Pagination 10 data per halaman

        return view('admin.pelanggan.pelanggan', compact('customers'));
    }

    public function customer_delete($id)
    {
        $user = User::findOrFail($id); // Menemukan user berdasarkan ID
    
        // Opsional: Menangani jika user memiliki relasi (misalnya pesanan atau data lainnya)
        // Anda bisa menambahkan pengecekan atau menghapus relasi terkait terlebih dahulu, jika perlu.
    
        $user->delete(); // Menghapus user berdasarkan ID
    
        return redirect()->route('customer.view')->with('success', 'Akun berhasil dihapus!');
    }
    


    public function index()
    {
        $products = Product::all();
        return view('customer.index', compact('products'));
    }


}
