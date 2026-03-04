<section class="section" id="blog">
    <div class="container">
        <div class="section-title">
            <span>LATEST UPDATES</span>
            <h2>Our Blog & Insights</h2>
            <p>Stay informed with the latest trends, tips, and news from the Australian property market.</p>
        </div>
        <div class="blog-grid">
            @foreach($posts as $post)
            <article class="blog-card">
                <div class="blog-img">
                    @if($post->cover_image)
                        <img src="{{ Str::startsWith($post->cover_image, 'http') ? $post->cover_image : asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}">
                    @endif
                    <span class="blog-category">{{ $post->category }}</span>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fa-regular fa-calendar"></i> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                        <span><i class="fa-regular fa-user"></i> Admin</span>
                    </div>
                    <h3><a href="#">{{ $post->title }}</a></h3>
                    <p>{{ $post->excerpt }}</p>
                    <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            @endforeach
        </div>
        <div class="blog-btn-container" style="text-align: center; margin-top: 50px;">
            <a href="#" class="btn-outline">Read More Guides</a>
        </div>
    </div>
</section>
