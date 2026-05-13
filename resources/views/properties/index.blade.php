@include('includes.header')

<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?auto=format&fit=crop&w=1920&q=80');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1>Premium Properties</h1>
            <p>Explore our curated collection of investment-grade real estate across the nation.</p>
        </div>
    </div>
</section>

<section class="section filter-section">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET" class="filter-form">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Property title or location...">
                </div>
                <div class="filter-group">
                    <label for="type">Property Type</label>
                    <select name="type" id="type">
                        <option value="">All Types</option>
                        <option value="Residential" {{ request('type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ request('type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Industrial" {{ request('type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Land" {{ request('type') == 'Land' ? 'selected' : '' }}>Land</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" value="{{ request('location') }}" placeholder="City, State...">
                </div>
                <div class="filter-group btn-group">
                    <button type="submit" class="btn-primary">Search Properties</button>
                    <a href="{{ route('properties.index') }}" class="btn-outline">Reset</a>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section">
    <div class="container">
        @if($properties->count())
            <div class="cards-grid">
                @foreach($properties as $property)
                @php
                    $features = json_decode($property->features, true) ?? [];
                @endphp
                <div class="card">
                    <div class="card-img">
                        @if($property->image)
                            <img src="{{ Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image) }}" alt="{{ $property->title }}">
                        @endif
                        <span class="card-tag">{{ $property->type ?? 'Property' }}</span>
                    </div>
                    <div class="card-content">
                        <div class="card-price">{{ $property->price_range }}</div>
                        <div class="card-title">{{ $property->title }}</div>
                        <div class="card-location"><i class="fa-solid fa-location-dot"></i> {{ $property->location }}</div>
                        <div class="card-features">
                            <span><i class="fa-solid fa-bed"></i> {{ $features['bed'] ?? 0 }}</span>
                            <span><i class="fa-solid fa-bath"></i> {{ $features['bath'] ?? 0 }}</span>
                            <span><i class="fa-solid fa-ruler-combined"></i> {{ $features['sqft'] ?? 0 }}</span>
                        </div>
                        <div class="card-actions" style="margin-top: 20px;">
                            <a href="{{ route('properties.show', $property->slug) }}" class="btn-outline" style="width: 100%; display: block; text-align: center;">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-wrapper" style="margin-top: 50px;">
                {{ $properties->links() }}
            </div>
        @else
            <div class="no-results" style="text-align: center; padding: 100px 0;">
                <i class="fa-solid fa-house-circle-exclamation" style="font-size: 4rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                <h3>No properties found</h3>
                <p>Try adjusting your search or filters to find what you're looking for.</p>
                <a href="{{ route('properties.index') }}" class="btn-primary" style="margin-top: 20px;">Clear all filters</a>
            </div>
        @endif
    </div>
</section>

@include('includes.footer')
