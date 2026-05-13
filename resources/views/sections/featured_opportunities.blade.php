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
                    <h3 class="card-title"><a href="{{ $card->link }}">{{ $card->title }}</a></h3>
                    <div class="card-location">{{ $card->location }}</div>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 1rem; margin-top: 1rem;">
                    <div class="card-features">
                        <span><i class="fa-solid fa-bed"></i> {{ $features['bed'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-bath"></i> {{ $features['bath'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-ruler-combined"></i> {{ $features['sqft'] ?? 0 }}</span>
                    </div>
                    <div class="card-footer">
                        <a href="{{ $card->link }}" class="btn-secondary btn-sm">View Details</a>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="{{ route('properties.index') }}" class="btn-primary">View All Properties</a>
        </div>
    </div>
</section>
