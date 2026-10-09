@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-page">

    <div class="dashboard-top">

        <div class="welcome-banner">

            <div class="welcome-content">
                <span class="welcome-small">WELCOME BACK,</span>

                <h1>RP Jewellers Admin Panel</h1>

                <p>
                    Manage your store, products, orders and customers from here.
                </p>

                <a href="{{ route('home') }}" class="store-btn">
                    View Store
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="welcome-decoration">
                <i class="fa-regular fa-gem"></i>
            </div>

        </div>

        <div class="today-card">

            <div class="today-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div>
                <span>Today</span>
                <h4>{{ now()->format('l, d M Y') }}</h4>
            </div>

            <p>
                “Great things are built with attention to detail.”
            </p>

            <small>— RP Jewellers</small>

        </div>

    </div>


    <div class="stats-grid">

        <div class="stat-card stat-products">

            <div class="stat-icon">
                <i class="fa-solid fa-box"></i>
            </div>

            <div class="stat-content">
                <span>Total Products</span>
                <h2>{{ $totalProducts ?? 0 }}</h2>

                <small>
                    <i class="fa-solid fa-arrow-up"></i>
                    Store Products
                </small>
            </div>

            <div class="stat-chart">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>


        <div class="stat-card stat-categories">

            <div class="stat-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <div class="stat-content">
                <span>Total Categories</span>
                <h2>{{ $totalCategories ?? 0 }}</h2>

                <small>
                    <i class="fa-solid fa-arrow-up"></i>
                    Active Categories
                </small>
            </div>

            <div class="stat-chart">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>


        <div class="stat-card stat-orders">

            <div class="stat-icon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>

            <div class="stat-content">
                <span>Total Orders</span>
                <h2>{{ $totalOrders ?? 0 }}</h2>

                <small>
                    <i class="fa-solid fa-arrow-up"></i>
                    Customer Orders
                </small>
            </div>

            <div class="stat-chart">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>


        <div class="stat-card stat-customers">

            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="stat-content">
                <span>Total Customers</span>
                <h2>{{ $totalCustomers ?? 0 }}</h2>

                <small>
                    <i class="fa-solid fa-arrow-up"></i>
                    Registered Users
                </small>
            </div>

            <div class="stat-chart">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>

    </div>


    <div class="dashboard-bottom">

        <div class="recent-orders-card">

            <div class="card-header">

                <div class="card-title">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h3>Recent Orders</h3>
                </div>

                <a href="{{ route('admin.orders.index') }}">
                    View All
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            <div class="orders-table-wrapper">

                <table class="orders-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentOrders ?? [] as $order)

                            <tr>

                                <td>
                                    #{{ $order->id }}
                                </td>

                                <td>
                                    {{ $order->user->name ?? 'Customer' }}
                                </td>

                                <td>
                                    ₹{{ number_format($order->total_amount ?? 0, 2) }}
                                </td>

                                <td>

                                    <span class="order-status status-{{ strtolower($order->status ?? 'pending') }}">
                                        {{ ucfirst($order->status ?? 'Pending') }}
                                    </span>

                                </td>

                                <td>
                                    {{ $order->created_at?->format('d M Y') }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.orders.show', $order->id) }}"
                                        class="view-btn"
                                    >
                                        View
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="empty-orders">
                                    No orders available yet.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <div class="dashboard-right">

            <div class="quick-actions-card">

                <div class="card-header">

                    <div class="card-title">
                        <i class="fa-solid fa-bolt"></i>
                        <h3>Quick Actions</h3>
                    </div>

                </div>


                <div class="quick-actions-grid">

                    <a href="{{ route('admin.products.create') }}" class="quick-action action-product">

                        <div>
                            <i class="fa-solid fa-box"></i>
                        </div>

                        <span>Add Product</span>

                    </a>


                    <a href="{{ route('admin.categories.create') }}" class="quick-action action-category">

                        <div>
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <span>Add Category</span>

                    </a>


                    <a href="{{ route('admin.orders.index') }}" class="quick-action action-order">

                        <div>
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>

                        <span>View Orders</span>

                    </a>


                    <a href="{{ route('admin.customers.index') }}" class="quick-action action-customer">

                        <div>
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <span>Customers</span>

                    </a>


                    <a href="{{ route('admin.blogs.create') }}" class="quick-action action-blog">

                        <div>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>

                        <span>Create Blog</span>

                    </a>


                    <a href="{{ route('admin.contacts.index') }}" class="quick-action action-contact">

                        <div>
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <span>Messages</span>

                    </a>

                </div>

            </div>


            <div class="store-promo">

                <div class="promo-content">

                    <span>RP JEWELLERS</span>

                    <h3>Manage Your Store</h3>

                    <p>
                        Grow your jewellery business with ease.
                    </p>

                    <a href="{{ route('admin.products.index') }}">
                        View Products
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

                <div class="promo-ring">
                    <i class="fa-regular fa-gem"></i>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection