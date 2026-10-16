@extends('admin.layouts.app')

@section('title', 'My Profile')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/admin/profile.css') }}">

<div class="admin-profile-page">

    <div class="profile-page-header">

        <div>
            <span class="profile-label">ACCOUNT SETTINGS</span>

            <h1>My Profile</h1>

            <p>Manage your administrator account</p>
        </div>

    </div>


    @if(session('success'))

        <div class="profile-alert profile-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>

    @endif


    @if($errors->any())

        <div class="profile-alert profile-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>Please fix the following errors:</strong>

                <ul>

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <div class="profile-grid">

        <div class="profile-summary-card">

            <div class="profile-cover"></div>

            <div class="profile-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="profile-summary-content">

                <span class="profile-role">
                    ADMINISTRATOR
                </span>

                <h2>{{ auth()->user()->name }}</h2>

                <p>{{ auth()->user()->email }}</p>

                <div class="profile-status">
                    <span></span>
                    Active Account
                </div>

            </div>


            <div class="profile-summary-divider"></div>


            <div class="profile-summary-item">

                <div class="summary-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <span>Account Role</span>
                    <strong>Administrator</strong>
                </div>

            </div>


            <div class="profile-summary-item">

                <div class="summary-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div>
                    <span>Email Address</span>
                    <strong>{{ auth()->user()->email }}</strong>
                </div>

            </div>


            <div class="profile-summary-item">

                <div class="summary-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <div>
                    <span>Member Since</span>

                    <strong>
                        {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : 'N/A' }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="profile-form-card">

            <div class="profile-form-header">

                <div class="profile-form-icon">
                    <i class="fa-solid fa-user-pen"></i>
                </div>

                <div>

                    <h2>Account Information</h2>

                    <p>
                        Update your personal information and password
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.profile.update') }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="profile-section-title">
                    Personal Information
                </div>


                <div class="profile-form-group">

                    <label for="name">
                        Full Name
                        <span>*</span>
                    </label>

                    <div class="profile-input-wrapper">

                        <i class="fa-solid fa-user"></i>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            placeholder="Enter your name"
                            required
                        >

                    </div>

                </div>


                <div class="profile-form-group">

                    <label for="email">
                        Email Address
                        <span>*</span>
                    </label>

                    <div class="profile-input-wrapper">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            placeholder="Enter your email"
                            required
                        >

                    </div>

                </div>


                <div class="profile-section-title password-title">
                    Change Password
                </div>


                <div class="password-info">

                    <i class="fa-solid fa-lock"></i>

                    <span>
                        Leave the password fields empty if you don't want to change your current password.
                    </span>

                </div>


                <div class="profile-form-group">

                    <label for="password">
                        New Password
                    </label>

                    <div class="profile-input-wrapper">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter new password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </button>

                    </div>

                </div>


                <div class="profile-form-group">

                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <div class="profile-input-wrapper">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm new password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </button>

                    </div>

                </div>


                <div class="profile-form-footer">

                    <div class="profile-security">

                        <i class="fa-solid fa-shield-halved"></i>

                        <span>
                            Your account information is protected.
                        </span>

                    </div>


                    <button
                        type="submit"
                        class="profile-update-btn"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Update Profile

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>

document.querySelectorAll('.password-toggle').forEach(function(button) {

    button.addEventListener('click', function() {

        const target = document.getElementById(
            this.getAttribute('data-target')
        );

        const icon = this.querySelector('i');

        if (target.type === 'password') {

            target.type = 'text';

            icon.classList.remove('fa-eye');

            icon.classList.add('fa-eye-slash');

        } else {

            target.type = 'password';

            icon.classList.remove('fa-eye-slash');

            icon.classList.add('fa-eye');

        }

    });

});

</script>

@endsection