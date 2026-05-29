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
                <p>Helping Australians Secure Their Dream Home and Build Wealth Through Trusted Property Opportunities.</p>
            <!-- <div class="hero-btns">
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
        </div> -->
            <div class="hero-btns">
                 <a href="{{ route('properties.index') }}" class="btn-hero">
                    <i class="fas fa-home"></i> Find Your Ideal Package
                </a>
               
                <a href="{{ url('/contact') }}" class="btn-hero">
                    <i class="fas fa-user-tie"></i> Speak to a Property Advisor
                </a>
                <a href="{{ url('/investors') }}" class="btn-hero">
                    <i class="fas fa-chart-line"></i> Start Your Investment Journey
                </a>
                <a href="https://calendly.com/brandodigital-support/30min" target="_blank" rel="noopener noreferrer" class="btn-hero">
                    <i class="fas fa-calendar-check"></i> Book a Free Consultation
                </a>
            </div>
            </div>
            
        </div>
        
    </div>
</section>
