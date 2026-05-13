<div class="info-row">
    <div class="info-img">
        <img src="{{ $pillar['image'] }}" alt="{{ $pillar['title'] }}">
    </div>
    <div class="info-text">
        
        <div style="display:flex;align-items:center">
            <div class="info-icon">
            <i class="{{ $pillar['icon'] }}"></i>
        </div>
        <h3 style="color: var(--primary-color);">{{ $pillar['title'] }}</h3>
</div>
        <p>{{ $pillar['description'] }}</p>
        <ul class="benefits-list">
            @foreach($pillar['benefits'] as $benefit)
                <li><i class="fa-solid fa-check"></i> {{ $benefit }}</li>
            @endforeach
        </ul>
        <div style="text-align: center; border-top:1px solid var(--border-color); padding-top: 2rem;"><a href="{{ $pillar['link'] }}" class="btn-secondary">{{ $pillar['link_label'] }}</a></div>
    </div>
</div>
