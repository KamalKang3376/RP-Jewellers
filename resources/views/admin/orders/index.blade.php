@extends('admin.layouts.app')

@section('title', 'Orders')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin/orders.css') }}">
@endpush

@section('content')

<div class="orders-page">

    <div class="page-header">

        <div class="page-header-content">

            <span class="page-label">
                STORE MANAGEMENT
            </span>

            <h1>
                Orders
            </h1>

            <p>
                Manage and track customer orders
            </p>

        </div>

        <div class="header-icon">
            <i class="fa-solid fa-bag-shopping"></i>
        </div>

    </div>


    @if(session('success'))

        <div class="success-alert">

            <div class="alert-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>
                {{ session('success') }}
            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="error-alert">

            <div class="alert-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div>
                {{ session('error') }}
            </div>

        </div>

    @endif


    <div class="order-stats">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <div class="stat-content">

                <span>
                    Total Orders
                </span>

                <strong>
                    {{ $orders->count() }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon pending">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div class="stat-content">

                <span>
                    Pending
                </span>

                <strong>
                    {{ $orders->where('status', 'pending')->count() }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon processing">
                <i class="fa-solid fa-box"></i>
            </div>

            <div class="stat-content">

                <span>
                    Processing
                </span>

                <strong>
                    {{ $orders->where('status', 'processing')->count() }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon completed">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="stat-content">

                <span>
                    Completed
                </span>

                <strong>
                    {{ $orders->where('status', 'completed')->count() }}
                </strong>

            </div>

        </div>

    </div>


    <div class="orders-card">

        <div class="orders-card-header">

            <div>

                <h2>
                    Customer Orders
                </h2>

                <p>
                    View and manage all customer purchases
                </p>

            </div>

            <div class="orders-count">

                <i class="fa-solid fa-receipt"></i>

                {{ $orders->count() }} Orders

            </div>

        </div>


        @if($orders->count() > 0)

            <div class="table-wrapper">

                <table class="orders-table">

                    <thead>

                        <tr>

                            <th>
                                Order
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Payment
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>

                                    <div class="order-number">

                                        <div class="order-icon">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                        </div>

                                        <div>

                                            <strong>
                                                #{{ $order->id }}
                                            </strong>

                                            <span>
                                                Order
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="customer-info">

                                        <div class="customer-avatar">

                                            {{ strtoupper(substr($order->user->name ?? 'C', 0, 1)) }}

                                        </div>

                                        <div>

                                            <strong>
                                                {{ $order->user->name ?? 'Guest Customer' }}
                                            </strong>

                                            <span>
                                                {{ $order->user->email ?? 'No email' }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="date-info">

                                        <strong>
                                            {{ $order->created_at->format('d M Y') }}
                                        </strong>

                                        <span>
                                            {{ $order->created_at->format('h:i A') }}
                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <strong class="order-total">

                                        ₹{{ number_format($order->total, 2) }}

                                    </strong>

                                </td>


                                <td>

                                    @php
                                        $paymentStatus = strtolower($order->payment_status ?? 'pending');
                                    @endphp

                                    <span class="payment-badge {{ $paymentStatus }}">

                                        @if($paymentStatus === 'paid')

                                            <i class="fa-solid fa-circle-check"></i>

                                        @else

                                            <i class="fa-solid fa-clock"></i>

                                        @endif

                                        {{ ucfirst($paymentStatus) }}

                                    </span>

                                </td>


                                <td>

                                    @php
                                        $status = strtolower($order->status ?? 'pending');
                                    @endphp

                                    <span class="status-badge {{ $status }}">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ ucfirst($status) }}

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.orders.show', $order->id) }}"
                                        class="view-order-btn"
                                    >

                                        <i class="fa-regular fa-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-orders">

                <div class="empty-icon">

                    <i class="fa-solid fa-bag-shopping"></i>

                </div>

                <h3>
                    No Orders Yet
                </h3>

                <p>
                    Customer orders will appear here once a purchase is completed.
                </p>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="browse-products-btn"
                >

                    <i class="fa-solid fa-box-open"></i>

                    View Products

                </a>

            </div>

        @endif

    </div>

</div>

@endsection