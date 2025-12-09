<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function showDashboard(Request $request)
    {
        // Total Order
        $totalOrders = Order::count();
    
        // Total Pendapatan dari order yang statusnya "success"
        $totalRevenue = Order::where('status', 'success')->sum('total_price');
    
        // Total Customer dengan role 'customer'
        $totalCustomers = User::where('role', 'customer')->count();
    
        // Total Produk
        $totalProducts = Product::count();
    
        // Recent Orders (5 pesanan terakhir yang bukan unpaid)
        $recentOrders = Order::with('customer', 'product')
                              ->where('status', '!=', 'unpaid')
                              ->orderBy('created_at', 'desc')
                              ->take(5)
                              ->get();
    
        // Filter berdasarkan waktu yang dipilih
        $dateRange = $this->getDateRange($request->input('time_filter'));
    
        // Ambil Top Products berdasarkan jumlah pesanan
        $topProducts = Product::withCount(['orders' => function($query) use ($dateRange) {
                if ($dateRange) {
                    $query->whereBetween('created_at', [$dateRange['start'], $dateRange['end']]);
                }
            }])
            ->orderByDesc('orders_count')
            ->take(3)  // Ambil 5 produk teratas
            ->get();
    
        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalCustomers', 'totalProducts', 'recentOrders', 'topProducts'));
    }
    
    // Fungsi untuk mendapatkan rentang waktu berdasarkan filter
    private function getDateRange($timeFilter)
    {
        $startDate = null;
        $endDate = null;
    
        switch ($timeFilter) {
            case 'This Month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'Last Month':
                $startDate = now()->subMonth()->startOfMonth();
                $endDate = now()->subMonth()->endOfMonth();
                break;
            case 'This Year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
        }
    
        return $startDate && $endDate ? ['start' => $startDate, 'end' => $endDate] : null;
    }
    
}
