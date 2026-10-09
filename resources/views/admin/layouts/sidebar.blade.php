<aside class="admin-sidebar">

    <div class="sidebar-logo">
        <a href="{{ route('admin.dashboard') }}">
            <span class="logo-icon">
                <i class="fa-regular fa-gem"></i>
            </span>

            <span class="logo-rp">RP</span>
            <span class="logo-text">JEWELLERS</span>
        </a>
    </div>

    <div class="sidebar-menu">

        <div class="menu-section">
            <span class="menu-title">MAIN</span>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </span>

                <span>Dashboard</span>
            </a>
        </div>


        <div class="menu-section">

            <span class="menu-title">STORE MANAGEMENT</span>

            <a href="{{ route('admin.products.index') }}"
               class="menu-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-gem"></i>
                </span>

                <span>Products</span>
            </a>


            <a href="{{ route('admin.categories.index') }}"
               class="menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </span>

                <span>Categories</span>
            </a>


            <a href="{{ route('admin.orders.index') }}"
               class="menu-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                </span>

                <span>Orders</span>
            </a>


            <a href="{{ route('admin.customers.index') }}"
               class="menu-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-users"></i>
                </span>

                <span>Customers</span>
            </a>

        </div>


        <div class="menu-section">

            <span class="menu-title">CONTENT</span>

            <a href="{{ route('admin.blogs.index') }}"
               class="menu-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>

                <span>Blog</span>
            </a>


            <a href="{{ route('admin.contacts.index') }}"
               class="menu-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-envelope"></i>
                </span>

                <span>Messages</span>

                @if(isset($unreadContacts) && $unreadContacts > 0)
                    <span class="menu-badge">
                        {{ $unreadContacts }}
                    </span>
                @endif

            </a>

        </div>


        <div class="menu-section">

            <span class="menu-title">ACCOUNT</span>

            <a href="{{ route('admin.profile') }}"
               class="menu-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">

                <span class="menu-icon">
                    <i class="fa-solid fa-user-circle"></i>
                </span>

                <span>My Profile</span>
            </a>

        </div>

    </div>


    <div class="sidebar-bottom">

        <form action="{{ route('admin.logout') }}" method="POST">

            @csrf

            <button type="submit" class="logout-link">

                <span class="menu-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>

                <span>Logout</span>

            </button>

        </form>

    </div>

</aside>