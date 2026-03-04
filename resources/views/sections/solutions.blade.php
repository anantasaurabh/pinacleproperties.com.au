<section class="section">
    <div class="container">
        <div class="section-title">
            <span>OUR EXPERTISE</span>
            <h2>Tailored Property Solutions</h2>
            <p>Experience a seamless journey with a real estate partner with our unique approach.</p>
        </div>
        <div class="solutions-grid">
            @foreach($services as $service)
            @if($service->type === 'solution')
            <div class="solution-card">
                <div class="solution-icon">
                    <i class="{{ $service->icon }} fa-2x"></i>
                </div>
                <h4>{{ $service->title }}</h4>
                <p>{{ $service->description }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
