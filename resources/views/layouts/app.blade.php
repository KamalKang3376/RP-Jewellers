
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'RP Jewellers')</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <!-- Navbar CSS -->
    <link
        rel="stylesheet"
        href="{{ secure_asset('css/navbar.css') }}"
    >

    <!-- Footer CSS -->
    <link
        rel="stylesheet"
        href="{{ secure_asset('css/footer.css') }}"
    >

    <!-- Page Specific CSS -->
    @stack('styles')

</head>

<body>

    <!-- Navbar -->
    <x-navbar />

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Page Specific JavaScript -->
    @stack('scripts')

</body>

</html>
