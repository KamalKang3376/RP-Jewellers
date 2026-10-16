@extends('admin.layouts.app')

@section('title', 'Messages | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/admin/contacts.css') }}">
@endpush

@section('content')

<div class="contacts-page">

    <div class="contacts-header">
        <div>
            <span class="page-label">CUSTOMER COMMUNICATION</span>
            <h1>Contact Messages</h1>
            <p>Messages received from customers</p>
        </div>

        <div class="message-count">
            <i class="fa-solid fa-envelope"></i>
            <span>{{ $contacts->count() }}</span>
            <small>Messages</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="messages-card">

        <div class="messages-card-header">
            <div>
                <h2>Customer Messages</h2>
                <p>View and manage customer enquiries</p>
            </div>

            <div class="messages-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
        </div>

        @if($contacts->count() > 0)

            <div class="messages-table-wrapper">

                <table class="messages-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($contacts as $contact)

                            <tr>

                                <td class="message-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="customer-info">

                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <strong>{{ $contact->name }}</strong>

                                            @if($contact->phone)
                                                <span>{{ $contact->phone }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <a
                                        href="mailto:{{ $contact->email }}"
                                        class="email-link"
                                    >
                                        {{ $contact->email }}
                                    </a>
                                </td>

                                <td>
                                    <span class="subject-text">
                                        {{ $contact->subject }}
                                    </span>
                                </td>

                                <td>
                                    <div class="date-info">
                                        <strong>
                                            {{ $contact->created_at->format('d M Y') }}
                                        </strong>

                                        <span>
                                            {{ $contact->created_at->format('h:i A') }}
                                        </span>
                                    </div>
                                </td>

                                <td>

                                    @if($contact->is_read)
                                        <span class="status-badge read">
                                            <i class="fa-solid fa-check"></i>
                                            Read
                                        </span>
                                    @else
                                        <span class="status-badge unread">
                                            <i class="fa-solid fa-circle"></i>
                                            New
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.contacts.show', $contact->id) }}"
                                        class="view-message"
                                        title="View Message"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                        <span>View</span>
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-messages">

                <div class="empty-icon">
                    <i class="fa-regular fa-envelope"></i>
                </div>

                <h3>No Messages Yet</h3>

                <p>
                    Customer messages submitted through the contact form
                    will appear here.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection