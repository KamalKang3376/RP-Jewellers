@extends('layouts.app')

@section('title', 'My Wishlist | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/wishlist.css') }}">
@endpush

@section('content')

<section class="wishlist-banner">

    <div class="container">

        <div class="wishlist-banner-content">

            <div class="wishlist-breadcrumb">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <span>›</span>

                <span>
                    Wishlist
                </span>

            </div>


            <h1>
                My Wishlist
            </h1>


            <p>
                Your favourite jewellery pieces in one place.
            </p>

        </div>

    </div>

</section>


<section class="wishlist-section">

    <div class="container">

        @if(session('success'))

            <div class="wishlist-alert">
                {{ session('success') }}
            </div>

        @endif


        @if($wishlists->count() > 0)

            <div class="wishlist-header">

                <div>

                    <span class="wishlist-small-title">
                        SAVED ITEMS
                    </span>

                    <h2>
                        Your Favourite Pieces
                    </h2>

                </div>


                <span class="wishlist-count">
                    {{ $wishlists->count() }}
                    {{ $wishlists->count() == 1 ? 'Item' : 'Items' }}
                </span>

            </div>


            <div class="wishlist-grid">

                @foreach($wishlists as $wishlist)

                    @php
                        $product = $wishlist->product;
                    @endphp


                    @if($product)

                        <article class="wishlist-card">

                            <div class="wishlist-image-box">

                                <a
                                    href="{{ route('product.show', $product->slug) }}"
                                    class="wishlist-image-link"
                                >

                                    @if($product->image)

                                        <img
                                            src="{{ asset('images/products/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="wishlist-product-image"
                                        >

                                    @else

                                        <div class="wishlist-image-placeholder">

                                            <i class="fa-solid fa-gem"></i>

                                        </div>

                                    @endif

                                </a>


                                @if($product->discount_price)

                                    <span class="wishlist-sale">
                                        SALE
                                    </span>

                                @endif


                                <form
                                    action="{{ route('wishlist.remove', $wishlist->id) }}"
                                    method="POST"
                                    class="wishlist-remove-form"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="wishlist-heart-button"
                                        title="Remove from Wishlist"
                                    >

                                        <i class="fa-solid fa-heart"></i>

                                    </button>

                                </form>

                            </div>


                            <div class="wishlist-card-content">

                                @if($product->category)

                                    <span class="wishlist-category">
                                        {{ $product->category->name }}
                                    </span>

                                @endif


                                <h3>

                                    <a
                                        href="{{ route('product.show', $product->slug) }}"
                                    >
                                        {{ $product->name }}
                                    </a>

                                </h3>


                                <div class="wishlist-rating">

                                    <span class="wishlist-stars">

                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>

                                    </span>

                                    <span>
                                        (4.8)
                                    </span>

                                    <span>
                                        12 reviews
                                    </span>

                                </div>


                                <div class="wishlist-price">

                                    @if($product->discount_price)

                                        <span class="wishlist-current-price">
                                            ₹{{ number_format($product->discount_price) }}
                                        </span>

                                        <del>
                                            ₹{{ number_format($product->price) }}
                                        </del>

                                    @else

                                        <span class="wishlist-current-price">
                                            ₹{{ number_format($product->price) }}
                                        </span>

                                    @endif

                                </div>


                                <div class="wishlist-actions">

                                    <a
                                        href="{{ route('product.show', $product->slug) }}"
                                        class="wishlist-view-button"
                                    >

                                        <span>
                                            View Product
                                        </span>

                                        <i class="fa-solid fa-arrow-right"></i>

                                    </a>

                                </div>

                            </div>

                        </article>

                    @endif

                @endforeach

            </div>

        @else

            <div class="empty-wishlist">

                <div class="empty-wishlist-icon">

                    <i class="fa-regular fa-heart"></i>

                </div>


                <span class="empty-wishlist-label">
                    YOUR WISHLIST
                </span>


                <h2>
                    Your Wishlist is Empty
                </h2>


                <p>
                    Save your favourite jewellery pieces and find them
                    here whenever you are ready.
                </p>


                <a
                    href="{{ route('shop') }}"
                    class="empty-wishlist-button"
                >

                    Explore Collection

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        @endif

    </div>

</section>

@endsection