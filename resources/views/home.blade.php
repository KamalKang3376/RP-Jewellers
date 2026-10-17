@extends('layouts.app')

@section('title', 'Home | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
@endpush

@section('content')

<section class="hero-section">

    <div class="container">

        <div class="hero-content">

            <p class="hero-subtitle">
                EXQUISITE JEWELLERY FOR EVERY MOMENT
            </p>

            <h1>
                Timeless Beauty,<br>
                Forever Yours
            </h1>

            <p class="hero-description">
                Discover handcrafted jewellery that celebrates
                your unique story.
            </p>

            <a href="{{ url('/shop') }}" class="hero-button">
                SHOP NOW
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>


<section class="service-section">

    <div class="container">

        <div class="row">

            <div class="col-lg-3 col-6 service-item">

                <i class="fa-solid fa-truck"></i>

                <div>
                    <h6>Free Delivery</h6>
                    <p>All Over India</p>
                </div>

            </div>

            <div class="col-lg-3 col-6 service-item">

                <i class="fa-solid fa-shield-halved"></i>

                <div>
                    <h6>Secure Payment</h6>
                    <p>100% Safe & Trusted</p>
                </div>

            </div>

            <div class="col-lg-3 col-6 service-item">

                <i class="fa-solid fa-gem"></i>

                <div>
                    <h6>Quality Guarantee</h6>
                    <p>Pure & Certified Jewellery</p>
                </div>

            </div>

            <div class="col-lg-3 col-6 service-item">

                <i class="fa-solid fa-certificate"></i>

                <div>
                    <h6>Guaranteed Savings</h6>
                    <p>Best Prices, Always</p>
                </div>

            </div>

        </div>

    </div>

</section>


<section class="categories-section">

    <div class="container">

        <div class="section-heading">

            <p>SHOP BY CATEGORY</p>

            <h2>
                Our Collections
            </h2>

            <span>
                Discover jewellery crafted for every occasion
            </span>

        </div>

        @foreach($categories as $category)
    <p>
        {{ $category->name }} —
        {{ $category->image ?? 'IMAGE IS EMPTY' }}
    </p>
    @endforeach


        <div class="row g-3">

            @forelse($categories as $category)

                <div class="col-lg-2 col-md-3 col-6">

                    <a href="{{ url('/shop?category=' . $category->slug) }}"
                       class="category-card">

                        <div class="category-image">

                            @if($category->image)

                                <img
                                    src="{{ asset('images/categories/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                >

                            @else

                                <div class="category-placeholder">
                                    <i class="fa-solid fa-gem"></i>
                                </div>

                            @endif

                        </div>

                        <div class="category-name">

                            <span>
                                {{ $category->name }}
                            </span>

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <p class="text-center">
                        No categories available.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


<section class="featured-section">

    <div class="container">

        <div class="featured-box">

            <div class="featured-content">

                <p>EXPLORE OUR COLLECTION</p>

                <h2>Royal Bridal Sets</h2>

                <span>
                    Exquisite bridal jewellery crafted
                    for your special day.
                </span>

                <a href="{{ url('/shop') }}">
                    SHOP COLLECTION
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>

<section class="products-section">

    <div class="container">

        <div class="section-heading">

            <p>DISCOVER OUR COLLECTION</p>

            <h2>Best Sellers</h2>

            <span>Our most loved jewellery pieces</span>

        </div>

        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-lg-3 col-md-4 col-6">

                    <div class="product-card">

                        <div class="product-image">

                            <a href="{{ route('product.show', $product->slug) }}">

                                @if($product->image)

                                    <img
                                        src="{{ asset('images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <div class="product-placeholder">
                                        <i class="fa-solid fa-gem"></i>
                                    </div>

                                @endif

                            </a>

                            @if($product->discount_price)

                                <span class="sale-badge">
                                    SALE
                                </span>

                            @endif

                        </div>


                        <div class="product-info">

                            @if($product->category)

                                <span class="product-category">
                                    {{ $product->category->name }}
                                </span>

                            @endif


                            <h3>

                                <a href="{{ route('product.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>

                            </h3>


                            <div class="product-rating">

                                <span class="stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>

                                <span class="rating-number">
                                    (4.8)
                                </span>

                                <span class="review-count">
                                    12 reviews
                                </span>

                            </div>


                            <div class="product-price">

                                @if($product->discount_price)

                                    <span class="current-price">
                                        ₹{{ number_format($product->discount_price) }}
                                    </span>

                                    <del>
                                        ₹{{ number_format($product->price) }}
                                    </del>

                                @else

                                    <span class="current-price">
                                        ₹{{ number_format($product->price) }}
                                    </span>

                                @endif

                            </div>


                            <a
                                href="{{ route('product.show', $product->slug) }}"
                                class="view-product-button"
                            >

                                <span>View Product</span>

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <p class="text-center">
                        No products available.
                    </p>

                </div>

            @endforelse

        </div>


        <div class="view-products">

            <a href="{{ url('/shop') }}">

                VIEW ALL PRODUCTS

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </div>

</section>

<section class="why-choose-section">

    <div class="container">

        <div class="section-heading why-heading">

            <p>WHY CHOOSE US</p>

            <h2>
                Why Choose Us?
            </h2>

            <span>
                Quality, trust and elegance in every piece
            </span>

        </div>


        <div class="row g-4">

            <div class="col-lg-3 col-md-6 col-6">

                <div class="why-card">

                    <div class="why-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>

                    <h3>
                        Certified Quality
                    </h3>

                    <p>
                        Every jewellery piece is carefully
                        selected for quality and authenticity.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 col-6">

                <div class="why-card">

                    <div class="why-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <h3>
                        Secure Shopping
                    </h3>

                    <p>
                        Shop confidently with secure payments
                        and a safe shopping experience.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 col-6">

                <div class="why-card">

                    <div class="why-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>

                    <h3>
                        Fast Delivery
                    </h3>

                    <p>
                        We carefully pack and deliver your
                        jewellery safely to your doorstep.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 col-6">

                <div class="why-card">

                    <div class="why-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <h3>
                        Made With Love
                    </h3>

                    <p>
                        Elegant designs created to make
                        your special moments memorable.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection