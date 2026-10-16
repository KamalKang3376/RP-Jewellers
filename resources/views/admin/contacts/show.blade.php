@extends('admin.layouts.app')

@section('title', 'Message Details | RP Jewellers')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin/contacts-show.css') }}">
@endpush

@section('content')

<div class="contact-show-page">

    <div class="page-top">

        <div class="page-title">
            <span>CUSTOMER COMMUNICATION</span>
            <h1>Message Details</h1>
            <p>View and manage customer enquiry</p>
        </div>

        <a href="{{ route('admin.contacts.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Messages
        </a>

    </div>


    <div class="message-layout">

        <div class="message-main">

            <div class="message-card">

                <div class="message-card-header">

                    <div class="subject-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>

                    <div class="subject-content">
                        <span>SUBJECT</span>

                        <h2>
                            {{ $contact->subject }}
                        </h2>

                        <p>
                            <i class="fa-regular fa-clock"></i>
                            {{ $contact->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                </div>


                <div class="message-body">

                    <div class="section-title">
                        <i class="fa-solid fa-message"></i>
                        <span>Customer Message</span>
                    </div>

                    <div class="message-box">

                        <div class="quote-icon">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>

                        <p>
                            {{ $contact->message }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="message-card customer-message-card">

                <div class="card-heading">
                    <div class="heading-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>
                        <h3>Customer Information</h3>
                        <p>Contact details of the customer</p>
                    </div>
                </div>


                <div class="customer-grid">

                    <div class="customer-detail">

                        <div class="detail-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <span>Name</span>
                            <strong>{{ $contact->name }}</strong>
                        </div>

                    </div>


                    <div class="customer-detail">

                        <div class="detail-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>
                            <span>Email</span>

                            <a href="mailto:{{ $contact->email }}">
                                {{ $contact->email }}
                            </a>
                        </div>

                    </div>


                    @if($contact->phone)

                        <div class="customer-detail">

                            <div class="detail-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>

                            <div>
                                <span>Phone</span>

                                <a href="tel:{{ $contact->phone }}">
                                    {{ $contact->phone }}
                                </a>
                            </div>

                        </div>

                    @endif


                    <div class="customer-detail">

                        <div class="detail-icon">
                            <i class="fa-solid fa-calendar"></i>
                        </div>

                        <div>
                            <span>Received</span>

                            <strong>
                                {{ $contact->created_at->format('d M Y') }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="message-sidebar">

            <div class="sidebar-card">

                <div class="sidebar-top">
                    <div class="customer-avatar">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>

                    <h3>{{ $contact->name }}</h3>

                    <span>Customer</span>
                </div>


                <div class="sidebar-actions">

                    <a
                        href="mailto:{{ $contact->email }}"
                        class="action-btn email"
                    >
                        <i class="fa-solid fa-envelope"></i>
                        Send Email
                    </a>

                    @if($contact->phone)

                        <a
                            href="tel:{{ $contact->phone }}"
                            class="action-btn call"
                        >
                            <i class="fa-solid fa-phone"></i>
                            Call Customer
                        </a>

                    @endif

                </div>

            </div>


            <div class="info-card">

                <div class="info-title">
                    <i class="fa-solid fa-circle-info"></i>
                    Message Information
                </div>

                <div class="info-row">
                    <span>Status</span>

                    @if($contact->is_read)
                        <strong class="status read">
                            <i class="fa-solid fa-check"></i>
                            Read
                        </strong>
                    @else
                        <strong class="status unread">
                            <i class="fa-solid fa-circle"></i>
                            New
                        </strong>
                    @endif
                </div>

                <div class="info-row">
                    <span>Message ID</span>
                    <strong>#{{ $contact->id }}</strong>
                </div>

                <div class="info-row">
                    <span>Date</span>
                    <strong>
                        {{ $contact->created_at->format('d M Y') }}
                    </strong>
                </div>

                <div class="info-row">
                    <span>Time</span>
                    <strong>
                        {{ $contact->created_at->format('h:i A') }}
                    </strong>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection