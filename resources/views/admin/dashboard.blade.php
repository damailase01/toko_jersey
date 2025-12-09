@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<body>
    <div class="main-content">
        <!-- Top Header -->
        <header class="dashboard-header">
            <div class="header-left">
                <h2>Dashboard Overview</h2>
                <p class="date-today">Friday, 11 January 2025</p>
            </div>
            
            <div class="header-right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search anything...">
                </div>
                
                <div class="header-actions">
                    <button class="action-btn">
                        <i class="far fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-envelope"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <div class="profile-quick-access">
                        <img src="/api/placeholder/40/40" alt="Profile">
                        <span>Alex M.</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stats Cards Section -->
        <section class="stats-section">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(86, 77, 242, 0.1)">
                    <i class="fas fa-shopping-cart" style="color: #564df2"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Orders</h3>
                    <h2>{{ $totalOrders }}</h2>
                    <p class="stat-growth positive">
                        
                        
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(25, 187, 155, 0.1)">
                    <i class="fas fa-wallet" style="color: #19bb9b"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Revenue</h3>
                    <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    <p class="stat-growth positive">
                      
                        
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(242, 153, 74, 0.1)">
                    <i class="fas fa-users" style="color: #f2994a"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Customers</h3>
                    <h2>{{ $totalCustomers }}</h2>
                    <p class="stat-growth positive">
                      
                        
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(242, 87, 87, 0.1)">
                    <i class="fas fa-box" style="color: #f25757"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Products</h3>
                    <h2>{{ $totalProducts }}</h2>
                    <p class="stat-growth negative">
                        
                        
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Dashboard Content -->
        <div class="dashboard-grid">
            <!-- Recent Orders Table -->
            <div class="dashboard-card orders-table">
                <div class="card-header">
                    <h3>Recent Orders</h3>
                    <button class="view-all-btn" onclick="window.location.href='{{route('transaksi.view.admin')}}">View All <i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td>#ORD-{{ $order->id }}</td>
                                    <td>
                                        <div class="customer-info">
                                            <span>{{ $order->user->name }}</span> <!-- Pastikan relasi customer ada dan role customer -->
                                        </div>
                                    </td>
                                    <td>{{ $order->product->name }}</td> <!-- Pastikan relasi product ada -->
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td> <!-- Sesuaikan dengan kolom yang benar -->
                                    <td><span class="status-badge {{ $order->status == 'success' ? 'complete' : 'pending' }}">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products Card -->
            <div class="dashboard-card top-products">
                <div class="card-header">
                    <h3>Top Products</h3>
                    <select class="time-filter" onchange="window.location.href = '?time_filter=' + this.value;">
                        <option value="This Month" {{ request('time_filter') == 'This Month' ? 'selected' : '' }}>This Month</option>
                        <option value="Last Month" {{ request('time_filter') == 'Last Month' ? 'selected' : '' }}>Last Month</option>
                        <option value="This Year" {{ request('time_filter') == 'This Year' ? 'selected' : '' }}>This Year</option>
                    </select>
                </div>
                <div class="products-list">
                    @foreach ($topProducts as $product)
                    <div class="product-item">
                        <img src="{{ asset('storage/' . $product->image_main) }}" alt="Product">
                        <div class="product-info">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ $product->orders_count }} orders this month</p>
                        </div>
                        <div class="product-stats">
                            <span class="amount">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="growth positive">+12.5%</span> <!-- Ganti dengan data pertumbuhan jika diperlukan -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</body>
@endsection
