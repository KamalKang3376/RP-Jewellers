@extends('admin.layouts.app')

@section('title', 'Order #' . $order->id)

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/admin/order-show.css') }}">
@endpush

@section('content')

<div class="order-page">

    <div class="order-page-header">

        <div>
            <span class="page-label">ORDER MANAGEMENT</span>

            <h1>
                Order #{{ $order->id }}
            </h1>

            <p>
                View and manage customer order
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Orders
        </a>

    </div>


    <div class="order-meta">

        <div class="order-meta-item">

            <div class="meta-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div>
                <span>Order Date</span>

                <strong>
                    {{ $order->created_at->format('d M Y, h:i A') }}
                </strong>
            </div>

        </div>


        <div class="order-meta-item">

            <div class="meta-icon">
                <i class="fa-solid fa-credit-card"></i>
            </div>

            <div>
                <span>Payment</span>

                <strong>
                    {{ strtoupper($order->payment_method ?? 'COD') }}
                </strong>
            </div>

        </div>


        <div class="order-meta-item">

            <div class="meta-icon">
                <i class="fa-solid fa-box"></i>
            </div>

            <div>
                <span>Items</span>

                <strong>
                    {{ $order->items->count() }}
                </strong>
            </div>

        </div>

    </div>


    <div class="order-layout">


        <div class="order-main">


            <div class="order-card">

                <div class="card-header">

                    <div>
                        <h2>Order Items</h2>

                        <p>
                            Products included in this order
                        </p>
                    </div>

                    <div class="item-count">
                        {{ $order->items->count() }}
                        {{ $order->items->count() == 1 ? 'Item' : 'Items' }}
                    </div>

                </div>


                <div class="order-items">

                    @forelse($order->items as $item)

                        <div class="order-item">


                            <div class="product-image">

                                @if(optional($item->product)->image)

                                    <img
                                        src="{{ asset('images/products/' . $item->product->image) }}"
                                        alt="{{ $item->product_name }}"
                                    >

                                @else

                                    <div class="no-product-image">
                                        <i class="fa-regular fa-gem"></i>
                                    </div>

                                @endif

                            </div>


                            <div class="product-details">

                                <h3>
                                    {{ $item->product_name }}
                                </h3>

                                <span class="product-label">
                                    RP JEWELLERS
                                </span>

                                <p>
                                    Jewellery Product
                                </p>

                            </div>


                            <div class="product-price">

                                <span>Price</span>

                                <strong>
                                    ₹{{ number_format($item->price, 2) }}
                                </strong>

                            </div>


                            <div class="product-quantity">

                                <span>Quantity</span>

                                <strong>
                                    {{ $item->quantity }}
                                </strong>

                            </div>


                            <div class="product-total">

                                <span>Total</span>

                                <strong>
                                    ₹{{ number_format($item->price * $item->quantity, 2) }}
                                </strong>

                            </div>


                        </div>

                    @empty

                        <div class="empty-order">

                            <div class="empty-icon">
                                <i class="fa-regular fa-gem"></i>
                            </div>

                            <h3>No Items Found</h3>

                            <p>
                                This order does not contain any products.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>



            <div class="order-card">

                <div class="card-header">

                    <div>
                        <h2>Delivery Address</h2>

                        <p>
                            Customer shipping information
                        </p>
                    </div>

                    <div class="address-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>

                </div>


                <div class="address-content">

                    <div class="address-name">
                        {{ $order->name }}
                    </div>

                    <p>
                        {{ $order->address }}
                    </p>

                    <p>
                        {{ $order->city }},
                        {{ $order->state }}
                        - {{ $order->pincode }}
                    </p>

                    <div class="contact-details">

                        <span>
                            <i class="fa-solid fa-phone"></i>
                            {{ $order->phone }}
                        </span>

                        <span>
                            <i class="fa-regular fa-envelope"></i>
                            {{ $order->email }}
                        </span>

                    </div>

                </div>

            </div>


        </div>



        <div class="order-sidebar">


            <div class="order-card customer-card">

                <div class="card-header">

                    <div>
                        <h2>Customer</h2>

                        <p>
                            Customer information
                        </p>
                    </div>

                    <div class="customer-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>

                </div>


                <div class="customer-info">

                    <div class="customer-avatar">
                        {{ strtoupper(substr($order->name, 0, 1)) }}
                    </div>

                    <div>

                        <h3>
                            {{ $order->name }}
                        </h3>

                        <p>
                            {{ $order->email }}
                        </p>

                    </div>

                </div>


                <div class="customer-contact">

                    <div>
                        <i class="fa-solid fa-phone"></i>

                        <span>
                            {{ $order->phone }}
                        </span>
                    </div>

                    <div>
                        <i class="fa-regular fa-envelope"></i>

                        <span>
                            {{ $order->email }}
                        </span>
                    </div>

                </div>

            </div>



            <div class="order-card">

                <div class="card-header">

                    <div>
                        <h2>Order Status</h2>

                        <p>
                            Update order progress
                        </p>
                    </div>

                    <div class="status-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>

                </div>


                <form
                    action="{{ route('admin.orders.update', $order->id) }}"
                    method="POST"
                    class="status-form"
                >

                    @csrf
                    @method('PUT')


                    <label for="status">
                        Current Status
                    </label>


                    <select
                        name="status"
                        id="status"
                        class="status-select"
                    >

                        <option
                            value="pending"
                            {{ $order->status === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="confirmed"
                            {{ $order->status === 'confirmed' ? 'selected' : '' }}
                        >
                            Confirmed
                        </option>

                        <option
                            value="processing"
                            {{ $order->status === 'processing' ? 'selected' : '' }}
                        >
                            Processing
                        </option>

                        <option
                            value="shipped"
                            {{ $order->status === 'shipped' ? 'selected' : '' }}
                        >
                            Shipped
                        </option>

                        <option
                            value="delivered"
                            {{ $order->status === 'delivered' ? 'selected' : '' }}
                        >
                            Delivered
                        </option>

                        <option
                            value="cancelled"
                            {{ $order->status === 'cancelled' ? 'selected' : '' }}
                        >
                            Cancelled
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="update-status-button"
                    >
                        <i class="fa-solid fa-check"></i>
                        Update Status
                    </button>

                </form>

            </div>



            <div class="order-card summary-card">

                <div class="card-header">

                    <div>
                        <h2>Order Summary</h2>

                        <p>
                            Payment details
                        </p>
                    </div>

                    <div class="summary-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>

                </div>


                <div class="summary-row">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        ₹{{ number_format($order->subtotal, 2) }}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Delivery
                    </span>

                    <strong class="free-delivery">
                        @if($order->shipping > 0)
                            ₹{{ number_format($order->shipping, 2) }}
                        @else
                            FREE
                        @endif
                    </strong>

                </div>


                <div class="summary-divider"></div>


                <div class="summary-total">

                    <span>
                        Total Amount
                    </span>

                    <strong>
                        ₹{{ number_format($order->total, 2) }}
                    </strong>

                </div>


                <div class="payment-status">

                    <span>Payment Status</span>

                    <strong class="payment-badge {{ $order->payment_status }}">
                        {{ ucfirst($order->payment_status ?? 'Pending') }}
                    </strong>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection