    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <img src="{{ asset('assets/images/pinnacle-logo.png') }}" alt="Logo" style="max-height:100px">
                    <!-- <p>Pinnacle Home & Investment is a premium real estate platform, providing our partners with the best in property services and development solutions.</p> -->
                    <p>Pinnacle Home & Investment Group Pty Ltd <br> ACN 697 393 016 of Level 10, 230 Collins Street,
Melbourne VIC 3000</p>
                    <div class="footer-social">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        @isset($footerQuick)
                            @foreach($footerQuick as $nav)
                                <li><a href="{{ $nav->link }}" target="{{ $nav->target }}">{{ $nav->label }}</a></li>
                            @endforeach
                        @else
                            <li><a href="/about">About Pinnacle Home & Investment</a></li>
                            <li><a href="/services">Services</a></li>
                            <li><a href="/contact">Contact</a></li>
                        @endisset
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        @isset($footerCompany)
                            @foreach($footerCompany as $nav)
                                <li><a href="{{ $nav->link }}" target="{{ $nav->target }}">{{ $nav->label }}</a></li>
                            @endforeach
                        @else
                            <li><a href="/about">Our Story</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        @endisset
                    </ul>
                </div>
                <div class="newsletter">
                    <h4>Newsletter</h4>
                    <p>Stay updated with the latest market ethics and announcements.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email Address">
                        <button type="submit" class="btn-submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="copyright">
                <p>© Pinnacle Home & Investment All Rights Reserved.</p>
                <p style="font-size: 12px; color: #666; margin-top: 10px; text-align: left;">Disclaimer: Pinnacle Home & Investment is an independent property referral network. We are
not a licensed real estate agency or financial advisor. Introductions are made only to verified
developers and licensed professionals. Referral rewards are transparent and disclosed.</p>
            </div>
        </div>
    </footer>
    <div class="acknowledgement-section">
        <div class="container">
            <div class="acknowledgement-content" tyle="font-size: 10px;">
                <h4>Acknowledgement of Country</h4>
                <p>Pinnacle Home and Investment Group acknowledges the Traditional Custodians of the lands across Australia on which we live and work.</p>
                <p>We acknowledge their connection to this Country and pay our respect to Elders past and present.</p>
            </div>
        </div>
    </div>
    <script>
        const mobileMenu = document.getElementById('mobile-menu');
        const navLinks = document.querySelector('nav');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = mobileMenu.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-xmark');
        });

        // Close menu when clicking a link
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                const icon = mobileMenu.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-xmark');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
