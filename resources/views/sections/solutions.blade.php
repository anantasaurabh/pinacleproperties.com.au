<section id="expertise" class="section">
    <div class="container">
        <div class="section-title">
            <span>OUR EXPERTISE</span>
            <h2>Tailored Property Solutions</h2>
            <p>Experience a seamless journey with a real estate partner who understands your unique goals.</p>
        </div>

        <div class="expertise-layout">
            <div class="expertise-image">
                <img src="{{ asset('assets/images/expertise-bg.png') }}" alt="Our Expertise">
            </div>
            
            <div class="expertise-card">
                <p class="expertise-intro">Our comprehensive approach ensures every detail of your property journey is managed with precision, from initial acquisition to long-term investment strategy.</p>
                
                <div class="expertise-list">
                    @foreach($services as $service)
                    @if($service->type === 'solution')
                    <div class="expertise-item">
                        <div class="item-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="item-content">
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
