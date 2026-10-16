@extends('layouts.app')

@section('title', 'Cart | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/cart.css') }}">
@endpush

@section('content')

<section class="cart-banner">

    <div class="container">

        <div class="cart-banner-content">

            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>></span>
                <span class="active">Cart</span>
            </div>

            <h1>Your Cart</h1>

            <p>
                Review your selected jewellery before checkout.
            </p>

        </div>

    </div>

</section>


<section class="cart-section">

    <div class="container">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(count($cart) > 0)

            <div class="row g-4">

                <div class="col-lg-8">

                    <div class="cart-products">

                        <div class="cart-header">

                            <span>Product</span>
                            <span>Price</span>
                            <span>Quantity</span>
                            <span>Total</span>
                            <span></span>

                        </div>


                        @php
                            $grandTotal = 0;
                        @endphp


                        @foreach($cart as $item)

                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $grandTotal += $itemTotal;
                            @endphp

                            <div class="cart-item">

                                <div class="cart-product">

                                    <img
                                        src="{{ asset('images/products/' . $item['image']) }}"
                                        alt="{{ $item['name'] }}"
                                    >

                                    <div>
                                        <h3>
                                            {{ $item['name'] }}
                                        </h3>

                                        <a href="{{ route('cart.remove', $item['id']) }}">
                                            Remove
                                        </a>
                                    </div>

                                </div>


                                <div class="cart-price">

                                    ₹{{ number_format($item['price']) }}

                                </div>


                                <form
                                    action="{{ route('cart.update', $item['id']) }}"
                                    method="POST"
                                    class="cart-quantity-form"
                                >

                                    @csrf

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                    >

                                    <button type="submit">
                                        Update
                                    </button>

                                </form>


                                <div class="cart-total">

                                    ₹{{ number_format($itemTotal) }}

                                </div>


                                <a
                                    href="{{ route('cart.remove', $item['id']) }}"
                                    class="cart-remove"
                                >
                                    ×
                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>


                <div class="col-lg-4">

                    <div class="cart-summary">

                        <h2>Cart Summary</h2>


                        <div class="summary-row">

                            <span>Subtotal</span>

                            <strong>
                                ₹{{ number_format($grandTotal) }}
                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>Shipping</span>

                            <strong>
                                FREE
                            </strong>

                        </div>


                        <div class="summary-total">

                            <span>Total</span>

                            <strong>
                                ₹{{ number_format($grandTotal) }}
                            </strong>

                        </div>


                        <a href="{{ route('checkout') }}" class="checkout-button">
                                PROCEED TO CHECKOUT
                            </a>


                        <a
                            href="{{ url('/shop') }}"
                            class="continue-shopping"
                        >
                            ← Continue Shopping
                        </a>


                        <a
                            href="{{ route('cart.clear') }}"
                            class="clear-cart"
                        >
                            Clear Cart
                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="empty-cart">

                <i class="fa-solid fa-bag-shopping"></i>

                <h2>Your Cart is Empty</h2>

                <p>
                    You haven't added any jewellery to your cart yet.
                </p>

                <a href="{{ url('/shop') }}">
                    START SHOPPING
                </a>

            </div>

        @endif

    </div>

</section>

@endsection