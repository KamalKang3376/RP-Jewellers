@extends('layouts.app')

@section('title', 'Collections | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/collections.css') }}">
@endpush

@section('content')

<section class="collections-banner">

    <div class="container">

        <div class="collections-banner-content">

            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>/</span>
                <span class="active">Collections</span>
            </div>

            <h1>Our Collections</h1>

            <p>
                Explore our exquisite collection of timeless jewellery.
            </p>

        </div>

    </div>

</section>


<section class="collections-section">

    <div class="container">

        <div class="collections-heading">

            <span>DISCOVER</span>

            <h2>Shop By Collection</h2>

            <p>
                Find the perfect piece from our carefully curated jewellery collections.
            </p>

        </div>


        @if($categories->count() > 0)

            <div class="row g-4">

                @foreach($categories as $category)

                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">

                        <div class="collection-card">

                            <div class="collection-image">

                                @if($category->image)

                                    <img
                                        src="{{ asset('images/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                    >

                                @else

                                    <div class="collection-placeholder">
                                        <i class="fa-solid fa-gem"></i>
                                    </div>

                                @endif


                                <div class="collection-overlay">

                                    <a
                                        href="{{ route('shop', ['category' => $category->slug]) }}"
                                        class="collection-btn"
                                    >
                                        EXPLORE
                                    </a>

                                </div>


                                <div class="collection-badge">

                                    <i class="fa-regular fa-gem"></i>

                                </div>

                            </div>


                            <div class="collection-info">

                                <h3>
                                    {{ $category->name }}
                                </h3>

                                <a
                                    href="{{ route('shop', ['category' => $category->slug]) }}"
                                    class="shop-now"
                                >

                                    <span>SHOP NOW</span>

                                    <i class="fa-solid fa-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="no-collections">

                <div class="no-collections-icon">
                    <i class="fa-solid fa-gem"></i>
                </div>

                <h2>No Collections Available</h2>

                <p>
                    Jewellery collections will appear here soon.
                </p>

                <a href="{{ route('shop') }}">
                    VISIT SHOP
                </a>

            </div>

        @endif

    </div>

</section>


<section class="collections-bottom">

    <div class="container">

        <div class="collections-bottom-content">

            <span>RP JEWELLERS</span>

            <h2>
                Timeless Jewellery For Every Occasion
            </h2>

            <p>
                Discover elegant designs crafted to make every moment special.
            </p>

            <a href="{{ route('shop') }}">
                SHOP ALL JEWELLERY
            </a>

        </div>

    </div>

</section>

@endsection