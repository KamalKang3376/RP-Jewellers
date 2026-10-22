@extends('layouts.app')

@section('title', 'Shop | RP Jewellers')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/shop.css') }}">
@endpush

@section('content')

<section class="shop-banner">
    <div class="container">
        <div class="shop-banner-content">
            <div class="shop-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>/</span>
                <span class="active">Shop</span>
            </div>

            <h1>Shop Jewellery</h1>
            <p>Discover timeless jewellery crafted for every special moment.</p>
        </div>
    </div>
</section>

<section class="shop-area">
    <div class="container">
        <div class="shop-layout">

            <aside class="shop-sidebar">
                <div class="sidebar-heading">
                    <h3>Shop By Categories</h3>
                </div>

                <div class="filter-list">
                    @foreach($categories as $cat)
                        <label class="filter-item">
                            <input
                                type="checkbox"
                                value="{{ $cat->slug }}"
                                onchange="applyFilter('category', this.value, this.checked)"
                                {{ request('category') == $cat->slug ? 'checked' : '' }}
                            >
                            <span>{{ $cat->name }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="sidebar-heading price-heading">
                    <h3>Price</h3>
                </div>

                <div class="filter-list">
                    <label class="filter-item">
                        <input
                            type="checkbox"
                            value="0-10000"
                            onchange="applyFilter('price_range', this.value, this.checked)"
                            {{ request('price_range') == '0-10000' ? 'checked' : '' }}
                        >
                        <span>Under ₹10,000</span>
                    </label>

                    <label class="filter-item">
                        <input
                            type="checkbox"
                            value="10000-25000"
                            onchange="applyFilter('price_range', this.value, this.checked)"
                            {{ request('price_range') == '10000-25000' ? 'checked' : '' }}
                        >
                        <span>₹10,000 - ₹25,000</span>
                    </label>

                    <label class="filter-item">
                        <input
                            type="checkbox"
                            value="25000+"
                            onchange="applyFilter('price_range', this.value, this.checked)"
                            {{ request('price_range') == '25000+' ? 'checked' : '' }}
                        >
                        <span>Above ₹25,000</span>
                    </label>
                </div>
            </aside>

            <main class="shop-products">

                <div class="shop-toolbar">
                    <div class="product-count">
                        @if(!empty($search))
                            <p>
                                Search results for
                                <strong>"{{ $search }}"</strong>
                            </p>
                        @else
                            <p>
                                Showing
                                <strong>{{ $products->count() }}</strong>
                                products
                            </p>
                        @endif
                    </div>

                    <div class="sort-box">
                        <select class="sort-select" onchange="applySort(this.value)">
                            <option
                                value="newest"
                                {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}
                            >
                                Newest First
                            </option>

                            <option
                                value="price_low"
                                {{ request('sort') == 'price_low' ? 'selected' : '' }}
                            >
                                Price: Low to High
                            </option>

                            <option
                                value="price_high"
                                {{ request('sort') == 'price_high' ? 'selected' : '' }}
                            >
                                Price: High to Low
                            </option>

                            <option
                                value="name"
                                {{ request('sort') == 'name' ? 'selected' : '' }}
                            >
                                Name: A to Z
                            </option>
                        </select>
                    </div>
                </div>

                @if($products->count() > 0)

                    <div class="products-grid">

                        @foreach($products as $product)

                            <article class="product-card">

                                <div class="product-image-box">

                                    <a
                                        href="{{ route('product.show', $product->slug) }}"
                                        class="product-image-link"
                                    >

                                        @if($product->image)

                                            @php
                                                $imagePath = str_starts_with($product->image, 'products/')
                                                    ? asset('storage/' . $product->image)
                                                    : asset('images/products/' . $product->image);
                                            @endphp

                                            <img
                                                src="{{ $imagePath }}"
                                                alt="{{ $product->name }}"
                                                class="product-image"
                                                loading="lazy"
                                                onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.image-placeholder').style.display='flex';"
                                            >

                                            <div class="image-placeholder" style="display: none;">
                                                <i class="fa-solid fa-gem"></i>
                                            </div>

                                        @else

                                            <div class="image-placeholder">
                                                <i class="fa-solid fa-gem"></i>
                                            </div>

                                        @endif

                                    </a>

                                    @if($product->discount_price)
                                        <span class="sale-label">SALE</span>
                                    @endif

                                    @auth
                                        @php
                                            $isWishlisted = in_array(
                                                $product->id,
                                                $wishlistProductIds ?? []
                                            );
                                        @endphp

                                        <button
                                            type="button"
                                            class="wishlist-button {{ $isWishlisted ? 'active' : '' }}"
                                            data-product-id="{{ $product->id }}"
                                            title="{{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
                                            onclick="toggleWishlist(this)"
                                        >
                                            <i class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                        </button>
                                    @else
                                        <a
                                            href="{{ route('login') }}"
                                            class="wishlist-button"
                                            title="Login to add to Wishlist"
                                        >
                                            <i class="fa-regular fa-heart"></i>
                                        </a>
                                    @endauth

                                </div>

                                <div class="product-details">

                                    @if($product->category)
                                        <span class="product-category">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif

                                    <h2 class="product-name">
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h2>

                                    <div class="product-rating">
                                        <span class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>

                                        <span class="rating-text">(4.8)</span>
                                        <span class="review-count">12 reviews</span>
                                    </div>

                                    <div class="product-price">

                                        @if($product->discount_price)
                                            <span class="discount-price">
                                                ₹{{ number_format($product->discount_price) }}
                                            </span>

                                            <del>
                                                ₹{{ number_format($product->price) }}
                                            </del>
                                        @else
                                            <span class="discount-price">
                                                ₹{{ number_format($product->price) }}
                                            </span>
                                        @endif

                                    </div>

                                    <a
                                        href="{{ route('product.show', $product->slug) }}"
                                        class="view-button"
                                    >
                                        <span>View Product</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="empty-products">
                        <div class="empty-icon">
                            <i class="fa-solid fa-gem"></i>
                        </div>

                        <h2>No Products Found</h2>

                        <p>
                            We couldn't find any jewellery matching your search or filters.
                        </p>

                        <a href="{{ route('shop') }}">
                            View All Products
                        </a>
                    </div>

                @endif

            </main>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function toggleWishlist(button) {
    const productId = button.dataset.productId;
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');

    if (!csrfMeta) {
        console.error('CSRF token not found.');
        return;
    }

    fetch(`/wishlist/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfMeta.getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Wishlist request failed');
        }

        return response.json();
    })
    .then(data => {
        const icon = button.querySelector('i');

        if (data.status === 'added') {
            button.classList.add('active');
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
            button.title = 'Remove from Wishlist';
        } else if (data.status === 'removed') {
            button.classList.remove('active');
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
            button.title = 'Add to Wishlist';
        }
    })
    .catch(error => {
        console.error('Wishlist Error:', error);
    });
}

function applyFilter(key, value, checked) {
    const url = new URL(window.location.href);

    if (checked) {
        url.searchParams.set(key, value);
    } else {
        url.searchParams.delete(key);
    }

    window.location.href = url.toString();
}

function applySort(value) {
    const url = new URL(window.location.href);

    if (value === 'newest') {
        url.searchParams.delete('sort');
    } else {
        url.searchParams.set('sort', value);
    }

    window.location.href = url.toString();
}
</script>
@endpush
