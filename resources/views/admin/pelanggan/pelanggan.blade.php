@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/pelanggan/pelanggan.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h2>Customer</h2>
            <div class="date-today">Kelola data customer Anda</div>
        </div>
        <div class="header-right">
            <div class="stats-card">
                <i class="fas fa-users"></i>
                <div class="stats-info">
                    <span class="stats-label">Total Customer</span>
                    <span class="stats-value">{{ $customers->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="category-container">
        <div class="category-header">
            <div class="header-wrapper">
                <h3>Daftar Customer</h3>
                <p class="subtitle">Manajemen data customer terdaftar</p>
            </div>
            <div class="header-actions">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari customer..." class="search-input">
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="category-table">
                <thead>
                    <tr>
                        <th>
                            <div class="th-content">
                                <span>No</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Nama</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Email</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>No. Telepon</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <span>Total Pesanan</span>
                                <i class="fas fa-sort"></i>
                            </div>
                        </th>
                        <th class="action-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $index => $customer)
                    <tr>
                        <td>
                            <span class="id-badge">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="customer-name">
                                <span>{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="customer-email">{{ $customer->email }}</span>
                        </td>
                        <td>
                            <span class="customer-phone">{{ $customer->phone_number }}</span>
                        </td>
                        <td>
                            <span class="order-count">{{ $customer->orders_count }} Pesanan</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                
                                
                                <form action="{{ route('customer.delete', $customer->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun customer ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action-btn unblock-btn" title="Buka Blokir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="showing-entries">
                Menampilkan {{ $customers->firstItem() }} sampai {{ $customers->lastItem() }} dari {{ $customers->total() }} data
            </div>
            <div class="pagination">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection