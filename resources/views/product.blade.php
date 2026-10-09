@extends('layouts.app')

@section('title', $product->name . ' | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endpush

@section('content')

<section class="product-detail-section">

    <div class="container">

        <div class="product-breadcrumb">

            <a href="{{ route('home') }}">
                Home
            </a>

            <span>/</span>

            <a href="{{ route('shop') }}">
                Shop
            </a>

            <span>/</span>

            <span>{{ $product->name }}</span>

        </div>


        <div class="row g-5 product-detail-row">

            <div class="col-lg-6">

                <div class="product-detail-image-box">

                    @if($product->discount_price)

                        <span class="product-sale-badge">
                            SALE
                        </span>

                    @endif


                    @if($product->image)

                        <img
                            src="{{ asset('images/products/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="product-detail-image"
                        >

                    @else

                        <div class="product-image-placeholder">

                            <i class="fa-solid fa-gem"></i>

                        </div>

                    @endif


                    <div class="product-wishlist">

                        @auth

                            <form
                                action="{{ route('wishlist.toggle', ['productId' => $product->id]) }}"
                                method="POST"
                                class="product-wishlist-form"
                                id="wishlist-form"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    id="wishlist-button"
                                    class="product-wishlist-btn {{ $isWishlisted ? 'active' : '' }}"
                                    title="{{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
                                >

                                    <i
                                        id="wishlist-icon"
                                        class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-heart"
                                    ></i>

                                </button>

                            </form>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="product-wishlist-btn"
                                title="Login to add wishlist"
                            >

                                <i class="fa-regular fa-heart"></i>

                            </a>

                        @endauth

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="product-detail-info">

                    @if($product->category)

                        <div class="product-category">

                            {{ $product->category->name }}

                        </div>

                    @endif


                    <h1 class="product-title">

                        {{ $product->name }}

                    </h1>


                    <div class="product-detail-price">

                        @if($product->discount_price)

                            <span class="current-price">

                                ₹{{ number_format($product->discount_price) }}

                            </span>

                            <del class="old-price">

                                ₹{{ number_format($product->price) }}

                            </del>

                        @else

                            <span class="current-price">

                                ₹{{ number_format($product->price) }}

                            </span>

                        @endif

                    </div>


                    @if($product->description)

                        <div class="product-description">

                            <p>

                                {{ $product->description }}

                            </p>

                        </div>

                    @endif


                    <div class="product-stock">

                        @if($product->stock > 0)

                            <span class="stock-available">

                                <i class="fa-solid fa-circle-check"></i>

                                In Stock

                            </span>

                        @else

                            <span class="stock-out">

                                <i class="fa-solid fa-circle-xmark"></i>

                                Out of Stock

                            </span>

                        @endif

                    </div>


                    @if($product->stock > 0)

                        <form
                            action="{{ route('cart.add') }}"
                            method="POST"
                            class="add-to-cart-form"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="product_id"
                                value="{{ $product->id }}"
                            >


                            <div class="quantity-wrapper">

                                <label for="quantity">
                                    Quantity
                                </label>

                                <div class="quantity-control">

                                    <button
                                        type="button"
                                        class="quantity-btn"
                                        onclick="decreaseQuantity()"
                                    >
                                        -
                                    </button>

                                    <input
                                        type="number"
                                        id="quantity"
                                        name="quantity"
                                        value="1"
                                        min="1"
                                        max="{{ $product->stock }}"
                                    >

                                    <button
                                        type="button"
                                        class="quantity-btn"
                                        onclick="increaseQuantity()"
                                    >
                                        +
                                    </button>

                                </div>

                            </div>


                            <button
                                type="submit"
                                class="add-cart-btn"
                            >

                                <i class="fa-solid fa-cart-shopping"></i>

                                Add to Cart

                            </button>

                        </form>

                    @else

                        <button
                            type="button"
                            class="add-cart-btn disabled"
                            disabled
                        >

                            Out of Stock

                        </button>

                    @endif


                    <div class="product-features">

                        <div class="feature-item">

                            <div class="feature-icon">

                                <i class="fa-solid fa-truck"></i>

                            </div>

                            <div>

                                <strong>
                                    Free Delivery
                                </strong>

                                <span>
                                    On orders above ₹5,000
                                </span>

                            </div>

                        </div>


                        <div class="feature-item">

                            <div class="feature-icon">

                                <i class="fa-solid fa-shield-halved"></i>

                            </div>

                            <div>

                                <strong>
                                    Secure Payment
                                </strong>

                                <span>
                                    100% secure checkout
                                </span>

                            </div>

                        </div>


                        <div class="feature-item">

                            <div class="feature-icon">

                                <i class="fa-solid fa-gem"></i>

                            </div>

                            <div>

                                <strong>
                                    Premium Quality
                                </strong>

                                <span>
                                    Genuine jewellery
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


@if(isset($relatedProducts) && $relatedProducts->count() > 0)

<section class="related-products-section">

    <div class="container">

        <div class="section-heading">

            <span>
                YOU MAY ALSO LIKE
            </span>

            <h2>
                Related Products
            </h2>

            <p>
                Explore more jewellery from this collection.
            </p>

        </div>


        <div class="row g-4">

            @foreach($relatedProducts as $relatedProduct)

                <div class="col-xl-3 col-lg-4 col-md-6 col-6">

                    <div class="related-product-card">

                        <div class="related-product-image">

                            <a href="{{ route('product.show', $relatedProduct->slug) }}">

                                @if($relatedProduct->image)

                                    <img
                                        src="{{ asset('images/products/' . $relatedProduct->image) }}"
                                        alt="{{ $relatedProduct->name }}"
                                    >

                                @else

                                    <div class="related-placeholder">

                                        <i class="fa-solid fa-gem"></i>

                                    </div>

                                @endif

                            </a>


                            @if($relatedProduct->discount_price)

                                <span class="related-sale">
                                    SALE
                                </span>

                            @endif


                            @auth

                                <form
                                    action="{{ route('wishlist.toggle', ['productId' => $relatedProduct->id]) }}"
                                    method="POST"
                                    class="related-wishlist-form"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="related-wishlist"
                                        title="Add to Wishlist"
                                    >

                                        <i class="fa-regular fa-heart"></i>

                                    </button>

                                </form>

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="related-wishlist"
                                    title="Login to add wishlist"
                                >

                                    <i class="fa-regular fa-heart"></i>

                                </a>

                            @endauth

                        </div>


                        <div class="related-product-info">

                            @if($relatedProduct->category)

                                <span class="related-category">

                                    {{ $relatedProduct->category->name }}

                                </span>

                            @endif


                            <h3>

                                {{ $relatedProduct->name }}

                            </h3>


                            <div class="related-price">

                                @if($relatedProduct->discount_price)

                                    <span>

                                        ₹{{ number_format($relatedProduct->discount_price) }}

                                    </span>

                                    <del>

                                        ₹{{ number_format($relatedProduct->price) }}

                                    </del>

                                @else

                                    <span>

                                        ₹{{ number_format($relatedProduct->price) }}

                                    </span>

                                @endif

                            </div>


                            <a
                                href="{{ route('product.show', $relatedProduct->slug) }}"
                                class="related-view-btn"
                            >

                                View Product

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection


@push('scripts')

<script>

function increaseQuantity()
{
    const quantityInput = document.getElementById('quantity');

    const maxQuantity = parseInt(quantityInput.max);

    let currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity < maxQuantity) {

        quantityInput.value = currentQuantity + 1;

    }
}


function decreaseQuantity()
{
    const quantityInput = document.getElementById('quantity');

    let currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity > 1) {

        quantityInput.value = currentQuantity - 1;

    }
}


const wishlistForm = document.getElementById('wishlist-form');

if (wishlistForm) {

    wishlistForm.addEventListener('submit', function(event) {

        event.preventDefault();

        const button = document.getElementById('wishlist-button');

        const icon = document.getElementById('wishlist-icon');

        button.disabled = true;

        fetch(this.action, {

            method: 'POST',

            headers: {

                'X-CSRF-TOKEN': document.querySelector(
                    '#wishlist-form input[name="_token"]'
                ).value,

                'Accept': 'application/json',

                'X-Requested-With': 'XMLHttpRequest'

            }

        })

        .then(response => {

            if (!response.ok) {

                throw new Error('Wishlist request failed');

            }

            return response.json();

        })

        .then(data => {

            if (data.status === 'added') {

                icon.classList.remove('fa-regular');

                icon.classList.add('fa-solid');

                button.classList.add('active');

                button.title = 'Remove from Wishlist';

            }

            if (data.status === 'removed') {

                icon.classList.remove('fa-solid');

                icon.classList.add('fa-regular');

                button.classList.remove('active');

                button.title = 'Add to Wishlist';

            }

        })

        .catch(error => {

            console.error(error);

        })

        .finally(() => {

            button.disabled = false;

        });

    });

}

</script>

@endpush