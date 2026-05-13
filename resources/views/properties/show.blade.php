@include('includes.header')

<section class="property-detail-header" style="background-image: url('{{ Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image) }}');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="property-header-content">
            <span class="card-tag">{{ $property->type ?? 'Property' }}</span>
            <h1>{{ $property->title }}</h1>
            <div class="property-meta">
                <span><i class="fa-solid fa-location-dot"></i> {{ $property->address ?: $property->location }}</span>
                <span><i class="fa-solid fa-tag"></i> {{ $property->price_range }}</span>
                <span><i class="fa-solid fa-circle-check"></i> {{ $property->status }}</span>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="property-grid">
            <div class="property-main">
                <div class="property-card-large">
                    @if($property->image)
                        <div class="main-image">
                            <img src="{{ Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image) }}" alt="{{ $property->title }}">
                        </div>
                    @endif
                    
                    <div class="property-description">
                        <h3>Description</h3>
                        <div class="content">
                            {!! nl2br(e($property->description ?: $property->short_description)) !!}
                        </div>
                    </div>

                    <div class="property-features-large">
                        <h3>Property Features</h3>
                        @php $features = json_decode($property->features, true) ?? []; @endphp
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fa-solid fa-bed"></i>
                                <span>{{ $features['bed'] ?? 0 }} Bedrooms</span>
                            </div>
                            <div class="feature-item">
                                <i class="fa-solid fa-bath"></i>
                                <span>{{ $features['bath'] ?? 0 }} Bathrooms</span>
                            </div>
                            <div class="feature-item">
                                <i class="fa-solid fa-ruler-combined"></i>
                                <span>{{ $features['sqft'] ?? 0 }} Sq Ft</span>
                            </div>
                            @if(isset($features['parking']))
                            <div class="feature-item">
                                <i class="fa-solid fa-car"></i>
                                <span>{{ $features['parking'] }} Parking</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="property-location">
                        <h3>Location</h3>
                        <p>{{ $property->address ?: $property->location }}</p>
                        <div class="map-container" id="map">
                            @if($property->map_lat && $property->map_lng)
                                <iframe 
                                    width="100%" 
                                    height="450" 
                                    style="border:0; border-radius: 12px;" 
                                    loading="lazy" 
                                    allowfullscreen 
                                    src="https://www.google.com/maps/embed/v1/view?key=YOUR_API_KEY_HERE&center={{ $property->map_lat }},{{ $property->map_lng }}&zoom=15">
                                </iframe>
                                <p class="text-muted" style="margin-top: 10px; font-size: 0.8rem;">* Map visualization requires a valid API key.</p>
                            @else
                                <div class="map-placeholder" style="background: #f0f0f0; height: 450px; display: flex; align-items: center; justify-content: center; border-radius: 12px; flex-direction: column;">
                                    <i class="fa-solid fa-map-location-dot" style="font-size: 3rem; color: #ccc; margin-bottom: 10px;"></i>
                                    <p>Map view for {{ $property->location }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <aside class="property-sidebar">
                <div class="contact-card">
                    <h3>Enquire About This Property</h3>
                    <form action="#" method="POST" class="contact-form">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="I am interested in this property..." required></textarea>
                        </div>
                        <button type="submit" class="btn-primary" style="width: 100%;">Send Inquiry</button>
                    </form>
                </div>

                <div class="agent-info">
                    <div class="agent-avatar">
                        <img src="https://i.pravatar.cc/150?u=agent" alt="Agent">
                    </div>
                    <div class="agent-details">
                        <h4>Jane Doe</h4>
                        <p>Senior Property Consultant</p>
                        <a href="tel:+1234567890"><i class="fa-solid fa-phone"></i> +1 234 567 890</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@if($suggested->count())
<section class="section bg-light">
    <div class="container">
        <div class="section-title">
            <span>EXPLORE MORE</span>
            <h2>Similar Properties</h2>
        </div>
        <div class="cards-grid">
            @foreach($suggested as $item)
            @php $f = json_decode($item->features, true) ?? []; @endphp
            <div class="card">
                <div class="card-img">
                    <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                </div>
                <div class="card-content">
                    <div class="card-price">{{ $item->price_range }}</div>
                    <div class="card-title">{{ $item->title }}</div>
                    <div class="card-location">{{ $item->location }}</div>
                    <div class="card-actions" style="margin-top: 15px;">
                        <a href="{{ route('properties.show', $item->slug) }}" class="btn-outline" style="width: 100%; display: block; text-align: center;">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('includes.footer')
