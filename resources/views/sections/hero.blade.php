<section class="hero">
    <video autoplay muted loop playsinline class="hero-video">
        <source src="{{ asset('assets/pinnacle-hero.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-content-main">
                <h1>Connecting Buyers, Investors, Professionals & Developers <span>Nationwide.</span></h1>
                <p>We make property connections simple, transparent, and trusted through our premium real estate ecosystems.</p>
            <div class="hero-btns">
            <a href="{{ url('/home-buyers') }}" class="btn-hero">
                <i class="fa-solid fa-house"></i>
                Home Buyers
            </a>
            <a href="{{ url('/investors') }}" class="btn-hero">
                <i class="fa-solid fa-chart-line"></i>
                Investors
            </a>
            <a href="{{ url('/partners') }}" class="btn-hero">
                <i class="fa-solid fa-handshake"></i>
                Partners
            </a>
            <a href="{{ url('/developers') }}" class="btn-hero">
                <i class="fa-solid fa-city"></i>
                Developers
            </a>
        </div>
            </div>
            
        </div>
        
    </div>
</section>
