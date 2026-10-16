<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin | RP Jewellers')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ secure_asset('css/admin/layout.css') }}"

    >
    <link
    rel="stylesheet"
    href="{{ secure_asset('css/admin/sidebar.css') }}"

>
<link rel="stylesheet" href="{{ secure_asset('css/admin/customers.css') }}">

    @stack('styles')

</head>

<body>

    <div class="admin-wrapper">

        @include('admin.layouts.sidebar')

        <div class="admin-main">

            @include('admin.layouts.navbar')

            <main class="admin-content">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>

</html>