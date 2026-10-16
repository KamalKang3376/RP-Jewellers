@extends('layouts.app')

@section('title', 'Login | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/auth.css') }}">
@endpush

@section('content')

<section class="auth-page">

    <div class="auth-decoration auth-decoration-left"></div>
    <div class="auth-decoration auth-decoration-right"></div>

    <div class="auth-container">

        <div class="auth-logo">

            <a href="{{ route('home') }}" class="auth-logo-link">

                <i class="fa-regular fa-gem"></i>

                <div class="auth-logo-text">

                    <strong>
                        RP JEWELLERS
                    </strong>

                    <div class="auth-logo-subtitle">

                        <span></span>

                        <small>
                            FINE JEWELLERY
                        </small>

                        <span></span>

                    </div>

                </div>

            </a>

        </div>


        <div class="auth-card">

            <div class="auth-image-panel">

                <div class="auth-image-overlay"></div>

                <div class="auth-image-content">

                    <div class="welcome-script">
                        Welcome Back
                    </div>

                    <h1>
                        to RP Jewellers
                    </h1>

                    <div class="welcome-divider">

                        <span></span>

                        <i class="fa-regular fa-gem"></i>

                        <span></span>

                    </div>

                    <p>
                        Your trusted destination for
                        <br>
                        timeless elegance and
                        <br>
                        exquisite jewellery.
                    </p>

                </div>

            </div>


            <div class="auth-form-panel">

                <div class="form-top-line"></div>

                <div class="auth-heading">

                    <h2>
                        Login
                    </h2>

                    <p>
                        Login to your RP Jewellers account.
                    </p>

                </div>


                @if(session('success'))

                    <div class="auth-alert auth-alert-success">
                        {{ session('success') }}
                    </div>

                @endif


                @if(session('error'))

                    <div class="auth-alert auth-alert-error">
                        {{ session('error') }}
                    </div>

                @endif


                @if($errors->any())

                    <div class="auth-alert auth-alert-error">

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif


                <form
                    action="{{ route('login.store') }}"
                    method="POST"
                    class="auth-form"
                >

                    @csrf


                    <div class="auth-field">

                        <label for="email">

                            <i class="fa-regular fa-envelope"></i>

                            <span>
                                Email Address
                            </span>

                        </label>

                        <div class="input-box">

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>


                    <div class="auth-field">

                        <label for="password">

                            <i class="fa-solid fa-lock"></i>

                            <span>
                                Password
                            </span>

                        </label>

                        <div class="input-box">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                aria-label="Show password"
                            >

                                <i class="fa-regular fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="auth-login-btn"
                    >

                        <span>
                            LOGIN
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>

                </form>


                <div class="auth-or">

                    <span></span>

                    <strong>
                        OR
                    </strong>

                    <span></span>

                </div>


                <div class="create-account">

                    <p>
                        Don't have an account?
                    </p>

                    <a href="{{ route('register') }}">

                        <span>
                            Create Account
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<script>

function togglePassword() {

    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.password-toggle i');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');

    } else {

        passwordInput.type = 'password';

        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');

    }

}

</script>

@endsection