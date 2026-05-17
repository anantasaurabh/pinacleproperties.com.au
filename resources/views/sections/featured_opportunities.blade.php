<section class="section">
    <div class="container">
        <div class="section-title">
            <span>PREMIUM SELECTION</span>
            <h2>Featured House & Land Packages</h2>
            <p class="lead text-muted">Discover our curated selection of premium house & land packages, handpicked for their exceptional quality and investment potential.</p>
        </div>
        <div class="cards-grid">
            @foreach($opportunities as $card)
                @include('properties.card', ['property' => $card])
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="{{ route('properties.index') }}" class="btn-primary">View All Packages</a>
        </div>
    </div>
</section>
