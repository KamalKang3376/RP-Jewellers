<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | RP Jewellers</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <!-- Admin Login CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/admin/login.css') }}"
    >

</head>

<body>

<div class="login-page">

    <div class="login-card">

        <!-- Logo -->
        <div class="login-logo">

            <div class="logo-icon">
                <i class="fa-solid fa-gem"></i>
            </div>

            <div class="logo-text">
                <span>RP</span>
                <small>JEWELLERS</small>
            </div>

        </div>

        <!-- Heading -->
        <div class="login-heading">
            <h1>Admin Login</h1>
            <p>Sign in to manage your jewellery store</p>
        </div>

        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form
            action="{{ route('admin.login.submit') }}"
            method="POST"
        >

            @csrf

            <!-- Email -->
            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <div class="input-box">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter admin email"
                        required
                    >

                </div>

            </div>

            <!-- Password -->
            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        onclick="togglePassword()"
                    >
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>

                </div>

            </div>

            <!-- Remember -->
            <div class="remember-row">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    <span>Remember me</span>

                </label>

            </div>

            <!-- Login Button -->
            <button
                type="submit"
                class="login-btn"
            >

                <i class="fa-solid fa-right-to-bracket"></i>

                Login

            </button>

        </form>

        <!-- Back -->
        <a
            href="{{ url('/') }}"
            class="back-link"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Store
        </a>

    </div>

</div>

<script>

function togglePassword() {

    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {

        password.type = 'text';

        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');

    } else {

        password.type = 'password';

        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');

    }

}

</script>

</body>
</html>