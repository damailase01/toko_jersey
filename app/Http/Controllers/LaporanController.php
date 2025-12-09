<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function keuangan(Request $request)
    {
           // Ambil tanggal filter jika ada, jika tidak gunakan tanggal default
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        // Pastikan startDate dan endDate adalah objek Carbon
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // Total pendapatan (semua)
        $totalPendapatan = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'success') // Filter berdasarkan status 'success'
            ->sum('total_price');

        // Pendapatan bulan ini
        $pendapatanBulanIni = Order::whereMonth('created_at', Carbon::now()->month)
                ->where('status', 'success') // Filter berdasarkan status 'success'
                ->sum('total_price');

        // Pendapatan hari ini
        $pendapatanHariIni = Order::whereDate('created_at', Carbon::today())
                ->where('status', 'success') // Filter berdasarkan status 'success'
                ->sum('total_price');

        // Ambil data orders untuk ditampilkan di tabel
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'success') // Filter berdasarkan status 'success'
            ->with('customer') // Relasi dengan customer (jika ada)
            ->get();

        // Pastikan variabel diteruskan ke view
        return view('admin.laporan.laporan', compact(
            'totalPendapatan', 'pendapatanBulanIni', 'pendapatanHariIni', 'orders', 'startDate', 'endDate'
        ));
    }
}
