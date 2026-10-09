<header class="site-header">

    <div class="top-bar">
        <div class="container">
            <div class="top-bar-inner">

                <div>
                    <span>
                        Free Delivery on Orders Above ₹5,000
                    </span>

                    <span>
                        <i class="fa-solid fa-shield-halved"></i>
                        Secure Payment
                    </span>
                </div>

                <div>
                    <span>
                        <i class="fa-solid fa-phone"></i>
                        +91 98765 43210
                    </span>

                    <span>
                        <i class="fa-solid fa-location-dot"></i>
                        Patiala, Punjab
                    </span>
                </div>

            </div>
        </div>
    </div>


    <div class="main-header">

        <div class="container">

            <div class="header-main-row">

                <button
                    class="mobile-menu-button"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNavbar"
                    aria-controls="mobileNavbar"
                    aria-label="Open navigation menu"
                >
                    <i class="fa-solid fa-bars"></i>
                </button>


                <a
                    href="{{ route('home') }}"
                    class="navbar-logo"
                >

                    <i class="fa-regular fa-gem logo-icon"></i>

                    <div class="logo-text">

                        <strong>
                            RP JEWELLERS
                        </strong>

                        <span>
                            FINE JEWELLERY
                        </span>

                    </div>

                </a>


                <div class="header-search">

                    <form
                        action="{{ route('shop') }}"
                        method="GET"
                    >

                        <input
                            type="text"
                            name="search"
                            placeholder="Search your favourite jewellery..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >

                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                    </form>

                </div>


                <div class="header-actions">

                    <button
                        type="button"
                        class="mobile-search-button"
                        data-bs-toggle="collapse"
                        data-bs-target="#mobileSearch"
                        aria-expanded="false"
                        aria-controls="mobileSearch"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>


                    <a
                        href="{{ auth()->check() ? route('account') : route('login') }}"
                        class="header-action"
                    >

                        <i class="fa-regular fa-user"></i>

                        <span>
                            My Account
                        </span>

                        @guest
                            <small>
                                Sign In / Register
                            </small>
                        @endguest

                    </a>


                    <a
                        href="{{ auth()->check() ? route('wishlist.index') : route('login') }}"
                        class="header-action"
                    >

                        <i class="fa-regular fa-heart"></i>

                        <span>
                            Wishlist
                        </span>

                    </a>


                    <a
                        href="{{ route('cart.index') }}"
                        class="header-action cart-action"
                    >

                        <i class="fa-solid fa-bag-shopping"></i>

                        <span>
                            My Cart
                        </span>

                        @if(session('cart') && count(session('cart')) > 0)

                            <small>
                                {{ count(session('cart')) }}
                            </small>

                        @endif

                    </a>

                </div>

            </div>


            <div
                class="collapse mobile-search-collapse"
                id="mobileSearch"
            >

                <div class="mobile-search">

                    <form
                        action="{{ route('shop') }}"
                        method="GET"
                    >

                        <input
                            type="text"
                            name="search"
                            placeholder="Search your favourite jewellery..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >

                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                    </form>

                </div>

            </div>


            <nav class="desktop-navbar">

                <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'active' : '' }}"
                >
                    Home
                </a>


                <a
                    href="{{ route('shop') }}"
                    class="{{ request()->routeIs('shop') && !request('sort') ? 'active' : '' }}"
                >
                    Shop
                </a>


                <a
                    href="{{ route('collections') }}"
                    class="{{ request()->routeIs('collections') ? 'active' : '' }}"
                >
                    Collections
                </a>


                <a
                    href="{{ route('shop', ['sort' => 'newest']) }}"
                    class="{{ request('sort') === 'newest' ? 'active' : '' }}"
                >
                    New Arrivals
                </a>


                <a
                    href="{{ route('blog') }}"
                    class="{{ request()->routeIs('blog') ? 'active' : '' }}"
                >
                    Blog
                </a>


                <a
                    href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'active' : '' }}"
                >
                    About Us
                </a>


                <a
                    href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'active' : '' }}"
                >
                    Contact Us
                </a>

            </nav>

        </div>

    </div>

</header>


<div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="mobileNavbar"
    aria-labelledby="mobileNavbarLabel"
>

    <div class="offcanvas-header">

        <div
            class="mobile-logo"
            id="mobileNavbarLabel"
        >

            <i class="fa-regular fa-gem"></i>

            <span>
                RP JEWELLERS
            </span>

        </div>


        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>

    </div>


    <div class="offcanvas-body">

        <nav class="mobile-navbar">

            <a
                href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'active' : '' }}"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    Home
                </span>

            </a>


            <a
                href="{{ route('shop') }}"
                class="{{ request()->routeIs('shop') && !request('sort') ? 'active' : '' }}"
            >

                <i class="fa-solid fa-shop"></i>

                <span>
                    Shop
                </span>

            </a>


            <a
                href="{{ route('collections') }}"
                class="{{ request()->routeIs('collections') ? 'active' : '' }}"
            >

                <i class="fa-regular fa-gem"></i>

                <span>
                    Collections
                </span>

            </a>


            <a
                href="{{ route('shop', ['sort' => 'newest']) }}"
                class="{{ request('sort') === 'newest' ? 'active' : '' }}"
            >

                <i class="fa-solid fa-wand-magic-sparkles"></i>

                <span>
                    New Arrivals
                </span>

            </a>


            <a
                href="{{ route('blog') }}"
                class="{{ request()->routeIs('blog') ? 'active' : '' }}"
            >

                <i class="fa-regular fa-newspaper"></i>

                <span>
                    Blog
                </span>

            </a>


            <a
                href="{{ route('about') }}"
                class="{{ request()->routeIs('about') ? 'active' : '' }}"
            >

                <i class="fa-regular fa-circle-question"></i>

                <span>
                    About Us
                </span>

            </a>


            <a
                href="{{ route('contact') }}"
                class="{{ request()->routeIs('contact') ? 'active' : '' }}"
            >

                <i class="fa-regular fa-envelope"></i>

                <span>
                    Contact Us
                </span>

            </a>


            <div class="mobile-menu-divider"></div>


            <a
                href="{{ auth()->check() ? route('account') : route('login') }}"
            >

                <i class="fa-regular fa-user"></i>

                <span>
                    My Account
                </span>

            </a>


            <a
                href="{{ auth()->check() ? route('wishlist.index') : route('login') }}"
            >

                <i class="fa-regular fa-heart"></i>

                <span>
                    Wishlist
                </span>

            </a>


            <a
                href="{{ route('cart.index') }}"
            >

                <i class="fa-solid fa-bag-shopping"></i>

                <span>
                    My Cart
                </span>

            </a>

        </nav>

    </div>

</div>