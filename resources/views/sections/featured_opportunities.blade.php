<section class="section">
    <div class="container">
        <div class="section-title">
            <span>PREMIUM SELECTION</span>
            <h2>Featured Opportunities</h2>
            <p class="lead text-muted">Discover our curated selection of premium properties, handpicked for their exceptional quality and investment potential.</p>
        </div>
        <div class="cards-grid">
            @foreach($opportunities as $card)
            @php
                $features = json_decode($card->features, true) ?? [];
            @endphp
            <div class="card">
                <div class="card-img">
                    @if($card->image)
                        <img src="{{ Str::startsWith($card->image, 'http') ? $card->image : asset('storage/' . $card->image) }}" alt="{{ $card->title }}">
                    @endif
                    <span class="card-tag">{{ $card->short_description }}</span>
                </div>
                <div class="card-content">
                    <div class="card-price">{{ $card->price_range }}</div>
                    <div class="card-title">{{ $card->title }}</div>
                    <div class="card-location">{{ $card->location }}</div>
                    <div class="card-features">
                        <span><i class="fa-solid fa-bed"></i> {{ $features['bed'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-bath"></i> {{ $features['bath'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-ruler-combined"></i> {{ $features['sqft'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="#" class="btn-outline">View All Properties</a>
        </div>
    </div>
</section>
