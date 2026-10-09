@extends('layouts.app')

@section('title', 'Checkout | RP Jewellers')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')

<div class="checkout-page">

    <div class="checkout-container">

        <div class="checkout-header">
            <span class="checkout-label">RP JEWELLERS</span>

            <h1>Checkout</h1>

            <p>
                Complete your details and place your jewellery order
            </p>
        </div>


        @if(session('success'))
            <div class="checkout-alert success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif


        @if(session('error'))
            <div class="checkout-alert error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        @if($errors->any())
            <div class="checkout-alert error">
                <i class="fa-solid fa-circle-exclamation"></i>

                <div>
                    <strong>Please fix the following:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <form
            action="{{ route('checkout.store') }}"
            method="POST"
            class="checkout-form"
        >

            @csrf

            <div class="checkout-grid">

                <div class="checkout-left">

                    <div class="checkout-card">

                        <div class="card-title">

                            <div class="title-icon">
                                <i class="fa-regular fa-user"></i>
                            </div>

                            <div>
                                <h2>Customer Information</h2>

                                <p>
                                    Enter your contact details
                                </p>
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="name">
                                    Full Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', auth()->user()->name ?? '') }}"
                                    placeholder="Enter your full name"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="email">
                                    Email Address <span>*</span>
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}"
                                    placeholder="Enter your email address"
                                    required
                                >

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="phone">
                                Phone Number <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Enter your phone number"
                                required
                            >

                        </div>

                    </div>


                    <div class="checkout-card">

                        <div class="card-title">

                            <div class="title-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div>
                                <h2>Delivery Address</h2>

                                <p>
                                    Where should we deliver your order?
                                </p>
                            </div>

                        </div>


                        <div class="form-group">

                            <label for="address">
                                Address <span>*</span>
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                placeholder="House number, street, area..."
                                required
                            >{{ old('address') }}</textarea>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="city">
                                    City <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    value="{{ old('city') }}"
                                    placeholder="Enter city"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="state">
                                    State <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="state"
                                    name="state"
                                    value="{{ old('state') }}"
                                    placeholder="Enter state"
                                    required
                                >

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="pincode">
                                PIN Code <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="pincode"
                                name="pincode"
                                value="{{ old('pincode') }}"
                                placeholder="Enter PIN code"
                                maxlength="10"
                                required
                            >

                        </div>

                    </div>


                    <div class="checkout-card">

                        <div class="card-title">

                            <div class="title-icon">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>

                            <div>
                                <h2>Payment Method</h2>

                                <p>
                                    Choose your preferred payment method
                                </p>
                            </div>

                        </div>


                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="cod"
                                checked
                            >

                            <span class="payment-radio"></span>

                            <span class="payment-icon">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </span>

                            <span class="payment-details">

                                <strong>
                                    Cash on Delivery
                                </strong>

                                <small>
                                    Pay when your jewellery is delivered
                                </small>

                            </span>

                        </label>


                        <label class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="online"
                            >

                            <span class="payment-radio"></span>

                            <span class="payment-icon">
                                <i class="fa-solid fa-credit-card"></i>
                            </span>

                            <span class="payment-details">

                                <strong>
                                    Online Payment
                                </strong>

                                <small>
                                    Secure online payment
                                </small>

                            </span>

                        </label>

                    </div>

                </div>


                <div class="checkout-right">

                    <div class="order-summary">

                        <div class="summary-header">

                            <h2>
                                Your Order
                            </h2>

                            <span>
                                {{ count($cart) }}
                                {{ count($cart) == 1 ? 'Item' : 'Items' }}
                            </span>

                        </div>


                        <div class="summary-products">

                            @foreach($cart as $item)

                                <div class="summary-product">

                                    <div class="product-image">

                                        @if(!empty($item['image']))

                                            <img
                                                src="{{ asset('images/products/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}"
                                            >

                                        @else

                                            <div class="no-image">
                                                <i class="fa-regular fa-gem"></i>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="product-info">

                                        <h3>
                                            {{ $item['name'] }}
                                        </h3>

                                        <p>
                                            Qty: {{ $item['quantity'] }}
                                        </p>

                                    </div>


                                    <strong class="product-price">

                                        ₹{{ number_format(
                                            $item['price'] * $item['quantity'],
                                            2
                                        ) }}

                                    </strong>

                                </div>

                            @endforeach

                        </div>


                        <div class="summary-divider"></div>


                        <div class="summary-row">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                ₹{{ number_format($subtotal, 2) }}
                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>
                                Delivery
                            </span>

                            <strong>

                                @if($shipping == 0)

                                    <span class="free-delivery">
                                        FREE
                                    </span>

                                @else

                                    ₹{{ number_format($shipping, 2) }}

                                @endif

                            </strong>

                        </div>


                        @if($subtotal < 5000)

                            <div class="delivery-note">

                                <i class="fa-solid fa-truck"></i>

                                <span>
                                    Add ₹{{ number_format(5000 - $subtotal, 2) }}
                                    more to get free delivery.
                                </span>

                            </div>

                        @else

                            <div class="delivery-note free">

                                <i class="fa-solid fa-circle-check"></i>

                                <span>
                                    You qualify for free delivery!
                                </span>

                            </div>

                        @endif


                        <div class="summary-divider"></div>


                        <div class="summary-total">

                            <span>
                                Total
                            </span>

                            <strong>
                                ₹{{ number_format($total, 2) }}
                            </strong>

                        </div>


                        <button
                            type="submit"
                            class="place-order-btn"
                        >

                            <i class="fa-solid fa-lock"></i>

                            <span>
                                Place Order
                            </span>

                        </button>


                        <a
                            href="{{ route('cart.index') }}"
                            class="back-cart-btn"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            Back to Cart

                        </a>


                        <div class="secure-checkout">

                            <i class="fa-solid fa-shield-halved"></i>

                            <div>

                                <strong>
                                    Secure Checkout
                                </strong>

                                <span>
                                    Your information is protected
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection