<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @isset($page)
        <title>{{ $page->meta_title ?? $page->title }} - Pinnacle Home & Investment</title>
        <meta name="description" content="{{ $page->meta_description ?? '' }}">
        <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @else
        <title>@yield('title', 'Pinnacle Home & Investment')</title>
    @endisset
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('assets/images/pinnacle-logo.png') }}?v=1" alt="Logo">
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    @isset($headerNav)
                        @foreach($headerNav as $nav)
                            <li><a href="{{ $nav->link }}" target="{{ $nav->target }}">{{ $nav->label }}</a></li>
                        @endforeach
                    @else
                        <li><a href="/">Home</a></li>
                        <li><a href="/properties">Properties</a></li>
                        <li><a href="/refer-a-friend">Refer a Friend</a></li>
                        <li><a href="/#about">About Us</a></li>
                        <li><a href="/#contact">Contact</a></li>
                    @endisset
                </ul>
            </nav>
            <div class="mobile-menu" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <img src="{{ asset('assets/images/pinnacle-logo.png') }}" alt="Logo" style="max-height:100px">
                    <p>Pinnacle Home & Investment Group Pty Ltd <br> ACN 697 393 016 of Level 10, 230 Collins Street, Melbourne VIC 3000</p>
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
                <p style="font-size: 12px; color: #666; margin-top: 10px; text-align: left;">Disclaimer: Pinnacle Home & Investment is an independent property referral network. We are not a licensed real estate agency or financial advisor.</p>
            </div>
        </div>
    </footer>

    <div class="acknowledgement-section">
        <div class="container">
            <div class="acknowledgement-content">
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
