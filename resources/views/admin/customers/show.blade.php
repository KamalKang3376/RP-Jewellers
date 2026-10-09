@extends('admin.layouts.app')

@section('title', 'Customer Details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/customer-show.css') }}">
@endpush

@section('content')

<div class="customer-show-page">

    <div class="customer-page-header">

        <div>
            <h1>Customer Details</h1>
            <p>View customer account information</p>
        </div>

        <a href="{{ route('admin.customers.index') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Customers
        </a>

    </div>

    <div class="customer-profile-card">

        <div class="profile-top">

            <div class="profile-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>

            <div class="profile-heading">
                <h2>{{ $customer->name }}</h2>
                <p>
                    <i class="fa-solid fa-envelope"></i>
                    {{ $customer->email }}
                </p>
            </div>

            <div class="account-status">
                <span>
                    <i class="fa-solid fa-circle"></i>
                    Active Customer
                </span>
            </div>

        </div>

        <div class="profile-divider"></div>

        <div class="customer-information">

            <div class="section-heading">
                <i class="fa-solid fa-user"></i>
                <div>
                    <h3>Personal Information</h3>
                    <p>Customer account details</p>
                </div>
            </div>

            <div class="information-grid">

                <div class="information-item">
                    <span class="information-label">
                        Customer ID
                    </span>

                    <strong>
                        #{{ $customer->id }}
                    </strong>
                </div>

                <div class="information-item">
                    <span class="information-label">
                        Full Name
                    </span>

                    <strong>
                        {{ $customer->name }}
                    </strong>
                </div>

                <div class="information-item">
                    <span class="information-label">
                        Email Address
                    </span>

                    <strong>
                        {{ $customer->email }}
                    </strong>
                </div>

                <div class="information-item">
                    <span class="information-label">
                        Registered On
                    </span>

                    <strong>
                        {{ $customer->created_at?->format('d M Y') ?? 'N/A' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span class="information-label">
                        Registration Time
                    </span>

                    <strong>
                        {{ $customer->created_at?->format('h:i A') ?? 'N/A' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span class="information-label">
                        Last Updated
                    </span>

                    <strong>
                        {{ $customer->updated_at?->format('d M Y') ?? 'N/A' }}
                    </strong>
                </div>

            </div>

        </div>

        <div class="profile-divider"></div>

        <div class="account-summary">

            <div class="summary-box">

                <div class="summary-icon">
                    <i class="fa-solid fa-user-check"></i>
                </div>

                <div>
                    <span>Account</span>
                    <strong>Registered</strong>
                </div>

            </div>

            <div class="summary-box">

                <div class="summary-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

                <div>
                    <span>Member Since</span>
                    <strong>
                        {{ $customer->created_at?->format('M Y') ?? 'N/A' }}
                    </strong>
                </div>

            </div>

            <div class="summary-box">

                <div class="summary-icon">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>

                <div>
                    <span>Email</span>
                    <strong>Available</strong>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection