@extends('layouts.app')

@section('title', 'Contact Us | RP Jewellers')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/contact.css') }}">
@endpush

@section('content')

<section class="contact-banner">
    <div class="container">
        <div class="contact-banner-content">

            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>/</span>
                <span class="active">Contact Us</span>
            </div>

            <h1>Contact Us</h1>

            <p>
                We'd love to hear from you. Get in touch with RP Jewellers.
            </p>

        </div>
    </div>
</section>

<section class="contact-section">

    <div class="container">

        <div class="contact-heading">

            <span>GET IN TOUCH</span>

            <h2>We Are Here To Help</h2>

            <p>
                Have a question about our jewellery, orders or collections?
                Send us a message and our team will get back to you.
            </p>

        </div>

        <div class="row g-5">

            <div class="col-lg-5">

                <div class="contact-info">

                    <h3>Contact Information</h3>

                    <p class="contact-info-text">
                        Visit us or get in touch with our team for any
                        jewellery-related queries.
                    </p>

                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>
                            <h4>Our Location</h4>
                            <p>Patiala, Punjab, India</p>
                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div>
                            <h4>Phone</h4>
                            <p>+91 98765 43210</p>
                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>
                            <h4>Email</h4>
                            <p>info@rpjewellers.com</p>
                        </div>

                    </div>

                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>

                        <div>
                            <h4>Business Hours</h4>
                            <p>Monday - Saturday: 10:00 AM - 7:00 PM</p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-7">

                <div class="contact-form-box">

                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    @endif

                    <h3>Send Us A Message</h3>

                    <form
                        action="{{ route('contact.submit') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="name">Name</label>

                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Your Name"
                                        required
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="email">Email</label>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Your Email"
                                        required
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="phone">Phone</label>

                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        placeholder="Your Phone"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="subject">Subject</label>

                                    <input
                                        type="text"
                                        id="subject"
                                        name="subject"
                                        value="{{ old('subject') }}"
                                        placeholder="Subject"
                                        required
                                    >

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group">

                                    <label for="message">Message</label>

                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="6"
                                        placeholder="Write your message..."
                                        required
                                    >{{ old('message') }}</textarea>

                                </div>

                            </div>

                            <div class="col-12">

                                <button
                                    type="submit"
                                    class="contact-submit"
                                >
                                    SEND MESSAGE
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="contact-bottom">

    <div class="container">

        <div class="contact-bottom-content">

            <span>RP JEWELLERS</span>

            <h2>Let Us Help You Find Something Special</h2>

            <p>
                Explore our jewellery collections and discover pieces
                designed for every special occasion.
            </p>

            <a href="{{ route('shop') }}">
                EXPLORE SHOP
            </a>

        </div>

    </div>

</section>

@endsection