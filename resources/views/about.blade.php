@extends('layouts.app')

@section('title', 'About Us | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/about.css') }}">
@endpush

@section('content')

<section class="about-banner">
    <div class="container">
        <div class="about-banner-content">

            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>/</span>
                <span class="active">About Us</span>
            </div>

            <h1>About RP Jewellers</h1>

            <p>
                Crafting timeless elegance, one beautiful piece at a time.
            </p>

        </div>
    </div>
</section>

<section class="about-story">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="about-image">

                    <img
                        src="{{ asset('images/about/about-jewellery1.jpg') }}"
                        alt="RP Jewellers"
                    >

                </div>

            </div>

            <div class="col-lg-6">

                <div class="about-content">

                    <span class="about-label">OUR STORY</span>

                    <h2>Where Elegance Meets Timeless Craftsmanship</h2>

                    <p>
                        At RP Jewellers, we believe that jewellery is more than
                        an accessory. It is a reflection of your personality,
                        your memories and the special moments of your life.
                    </p>

                    <p>
                        Our collection brings together elegant designs,
                        beautiful craftsmanship and timeless style to create
                        jewellery that can be cherished for years to come.
                    </p>

                    <p>
                        From everyday elegance to jewellery for life's most
                        memorable occasions, we offer carefully selected
                        pieces designed to make every moment special.
                    </p>

                    <a href="{{ route('shop') }}" class="about-btn">
                        EXPLORE OUR COLLECTION
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

<section class="about-values">

    <div class="container">

        <div class="about-heading">

            <span>WHY RP JEWELLERS</span>

            <h2>Our Values</h2>

            <p>
                We focus on quality, elegance and creating a memorable
                jewellery experience for every customer.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">

                <div class="value-card">

                    <div class="value-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>

                    <h3>Quality</h3>

                    <p>
                        We believe every piece of jewellery should reflect
                        attention to detail and lasting beauty.
                    </p>

                </div>

            </div>

            <div class="col-lg-4 col-md-6">

                <div class="value-card">

                    <div class="value-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <h3>Elegance</h3>

                    <p>
                        Our designs combine timeless elegance with styles
                        suitable for today's jewellery lovers.
                    </p>

                </div>

            </div>

            <div class="col-lg-4 col-md-6">

                <div class="value-card">

                    <div class="value-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>

                    <h3>Trust</h3>

                    <p>
                        We aim to build lasting relationships with our
                        customers through a reliable shopping experience.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="about-occasion">

    <div class="container">

        <div class="about-occasion-content">

            <span>JEWELLERY FOR EVERY MOMENT</span>

            <h2>Celebrate Your Special Moments</h2>

            <p>
                Discover jewellery for weddings, celebrations, gifts and
                everyday moments.
            </p>

            <a href="{{ route('shop') }}">
                SHOP JEWELLERY
            </a>

        </div>

    </div>

</section>

@endsection