<footer class="site-footer">

    <div class="container">

        <div class="row footer-main">

            <div class="col-lg-4 col-md-6 footer-brand">

                <div class="footer-logo">

                    <span>RP</span>

                    <div>
                        <strong>JEWELLERS</strong>
                        <small>Timeless Elegance</small>
                    </div>

                </div>

                <p>
                    Luxury jewellery for every occasion.
                    Crafted with passion, designed for you.
                </p>

                <div class="footer-social">

                    <a href="#" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" aria-label="Pinterest">
                        <i class="fa-brands fa-pinterest-p"></i>
                    </a>

                    <a href="#" aria-label="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                </div>

            </div>


            <div class="col-lg-2 col-md-6 footer-column">

                <h5>Quick Links</h5>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shop') }}">
                            Shop
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('collections') }}">
                            Collections
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Contact Us
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-3 col-md-6 footer-column">

                <h5>Customer Care</h5>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route('contact') }}">
                            Shipping & Returns
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Terms & Conditions
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Customer Support
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-3 col-md-6 footer-column">

                <h5>Contact Us</h5>

                <div class="footer-contact">

                    <p>

                        <i class="fa-solid fa-phone"></i>

                        <a href="tel:+919876543210">
                            +91 98765 43210
                        </a>

                    </p>


                    <p>

                        <i class="fa-solid fa-envelope"></i>

                        <a href="mailto:info@rpjewellers.com">
                            info@rpjewellers.com
                        </a>

                    </p>


                    <p>

                        <i class="fa-solid fa-location-dot"></i>

                        <a href="{{ route('contact') }}">
                            Patiala, Punjab, India
                        </a>

                    </p>

                </div>

            </div>

        </div>


        <div class="footer-bottom">

            <p>
                © {{ date('Y') }} RP Jewellers.
                All Rights Reserved.
            </p>

            <div class="payment-icons">

                <span>VISA</span>

                <span>MC</span>

                <span>UPI</span>

            </div>

        </div>

    </div>

</footer>