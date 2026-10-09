@extends('layouts.app')

@section('title', 'Create Account | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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


        <div class="auth-card register-card">

            <div class="auth-image-panel register-image-panel">

                <div class="auth-image-overlay"></div>

                <div class="auth-image-content">

                    <div class="welcome-script">
                        Welcome
                    </div>

                    <h1>
                        Join RP Jewellers
                    </h1>

                    <div class="welcome-divider">

                        <span></span>

                        <i class="fa-regular fa-gem"></i>

                        <span></span>

                    </div>

                    <p>
                        Create your account and discover
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
                        Create Account
                    </h2>

                    <p>
                        Register to begin your RP Jewellers journey.
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
                    action="{{ route('register.store') }}"
                    method="POST"
                    class="auth-form"
                >

                    @csrf


                    <div class="auth-field">

                        <label for="name">

                            <i class="fa-regular fa-user"></i>

                            <span>
                                Full Name
                            </span>

                        </label>

                        <div class="input-box">

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                autocomplete="name"
                                required
                            >

                        </div>

                    </div>


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


                    <div class="register-row">

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
                                    placeholder="Password"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="toggleRegisterPassword('password', this)"
                                >

                                    <i class="fa-regular fa-eye"></i>

                                </button>

                            </div>

                        </div>


                        <div class="auth-field">

                            <label for="password_confirmation">

                                <i class="fa-solid fa-lock"></i>

                                <span>
                                    Confirm Password
                                </span>

                            </label>

                            <div class="input-box">

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Confirm password"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="toggleRegisterPassword('password_confirmation', this)"
                                >

                                    <i class="fa-regular fa-eye"></i>

                                </button>

                            </div>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="auth-login-btn"
                    >

                        <span>
                            CREATE ACCOUNT
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
                        Already have an account?
                    </p>

                    <a href="{{ route('login') }}">

                        <span>
                            Login Now
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>


        <div class="auth-features">

            <div class="auth-feature">

                <div class="feature-icon">
                    <i class="fa-solid fa-truck"></i>
                </div>

                <div class="feature-content">

                    <h3>
                        Free Delivery
                    </h3>

                    <p>
                        On Orders Above ₹5,000
                    </p>

                </div>

            </div>


            <div class="auth-feature">

                <div class="feature-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div class="feature-content">

                    <h3>
                        Secure Payment
                    </h3>

                    <p>
                        100% Safe & Secure
                    </p>

                </div>

            </div>


            <div class="auth-feature">

                <div class="feature-icon">
                    <i class="fa-regular fa-gem"></i>
                </div>

                <div class="feature-content">

                    <h3>
                        Premium Quality
                    </h3>

                    <p>
                        Certified Jewellery
                    </p>

                </div>

            </div>


            <div class="auth-feature">

                <div class="feature-icon">
                    <i class="fa-solid fa-headset"></i>
                </div>

                <div class="feature-content">

                    <h3>
                        24/7 Support
                    </h3>

                    <p>
                        We're Always Here
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<script>

function toggleRegisterPassword(fieldId, button) {

    const input = document.getElementById(fieldId);
    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');

    }

}

</script>

@endsection