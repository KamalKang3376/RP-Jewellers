@extends('layouts.app')

@section('title', 'My Account | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')

<section class="account-hero">

    <div class="account-hero-decoration account-decoration-left">
        <i class="fa-regular fa-gem"></i>
    </div>

    <div class="account-hero-decoration account-decoration-right">
        <i class="fa-regular fa-gem"></i>
    </div>

    <div class="container">

        <div class="account-hero-content">

            <div class="account-breadcrumb">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <span>›</span>

                <span>
                    My Account
                </span>

            </div>

            <h1>
                My Account
            </h1>

            <div class="account-hero-line">

                <span></span>

                <i class="fa-regular fa-gem"></i>

                <span></span>

            </div>

            <p>
                Manage your orders, details and wishlist all in one place.
            </p>

        </div>

    </div>

</section>


<section class="account-section">

    <div class="container">

        <div class="account-wrapper">

            <div class="account-profile">

                <div class="profile-icon">

                    <i class="fa-regular fa-user"></i>

                </div>


                <h2>
                    {{ $user->name }}
                </h2>


                <div class="profile-email">

                    <i class="fa-regular fa-envelope"></i>

                    <span>
                        {{ $user->email }}
                    </span>

                </div>


                <div class="profile-divider"></div>


                <p class="profile-description">

                    We're delighted to have you with us.
                    Explore your account and enjoy a seamless
                    jewellery shopping experience.

                </p>

            </div>


            <div class="account-dashboard">

                <div class="dashboard-heading">

                    <h3>
                        Account Dashboard
                    </h3>

                    <span></span>

                </div>


                <div class="dashboard-cards">

                    <a
                        href="{{ route('cart.index') }}"
                        class="dashboard-card"
                    >

                        <div class="dashboard-icon">

                            <i class="fa-solid fa-bag-shopping"></i>

                        </div>

                        <h4>
                            My Orders
                        </h4>

                        <p>
                            View your order history,
                            track your latest purchases
                            and check delivery status.
                        </p>

                        <div class="dashboard-arrow">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </a>


                    <a
                        href="{{ route('account') }}"
                        class="dashboard-card"
                    >

                        <div class="dashboard-icon">

                            <i class="fa-regular fa-user"></i>

                        </div>

                        <h4>
                            Account Details
                        </h4>

                        <p>
                            View your personal
                            information, email address
                            and account details.
                        </p>

                        <div class="dashboard-arrow">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </a>


                    <a
                        href="{{ route('wishlist.index') }}"
                        class="dashboard-card"
                    >

                        <div class="dashboard-icon">

                            <i class="fa-regular fa-heart"></i>

                        </div>

                        <h4>
                            Wishlist
                        </h4>

                        <p>
                            View and manage your
                            favourite jewellery pieces
                            in one place.
                        </p>

                        <div class="dashboard-arrow">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </a>

                </div>


                <div class="logout-area">

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="logout-button"
                        >

                            <i class="fa-solid fa-right-from-bracket"></i>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection