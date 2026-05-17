@php
    $features = json_decode($property->features, true) ?? [];
    $detailUrl = $property->slug ? route('properties.show', $property->slug) : ($property->link ?: '#');
    $homeAreaClean = isset($property->area) ? trim(str_ireplace(['sqm', 'sq.m', 'sq m', 'sqmeters', ' '], '', $property->area)) : null;
    $blockAreaClean = isset($property->block_area) ? trim(str_ireplace(['sqm', 'sq.m', 'sq m', 'sqmeters', ' '], '', $property->block_area)) : null;
@endphp

<div class="card">
    <div class="card-img">
        <a href="{{ $detailUrl }}" style="display: block; width: 100%; height: 100%;">
            @if($property->image)
                <img src="{{ Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image) }}" alt="{{ $property->title }}">
            @else
                <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $property->title }}">
            @endif
        </a>
        <span class="card-tag">{{ $property->country ?: ($property->type ?? 'VIC') }}</span>
        
        @if(isset($property->status) && $property->status !== 'Available')
            <span class="card-status-badge {{ strtolower(str_replace(' ', '-', $property->status)) }}">
                {{ $property->status }}
            </span>
        @endif
    </div>
    
    <div class="card-content">
        <div style="display: flex; align-items: center; justify-content: space-between;" >
        <div class="card-price">
            {{ $property->price_range ?: ($property->price ? '$' . number_format($property->price) : 'Contact Agent') }}
        </div>
        @if($homeAreaClean || $blockAreaClean)
            <div class="card-areas" style="display: none;">
                @if($homeAreaClean)
                    <span title="Home Area" style="display: flex; align-items: center; gap: 5px;"><i class="fa-solid fa-house-chimney"></i> {{ $homeAreaClean }} sqm </span>
                @endif
                
                @if($blockAreaClean)
                    <span title="Block Area" style="display: flex; align-items: center; gap: 5px;"><i class="fa-solid fa-ruler-combined"></i> {{ $blockAreaClean }} sqm </span>
                @endif
            </div>
        @endif
</div>
        <h3 class="card-title">
            <a href="{{ $detailUrl }}">{{ $property->title }}</a>
        </h3>
        
        <div class="card-location text-muted">
            <i class="fa-solid fa-location-dot"></i>
            @if(isset($property->suburb) && $property->suburb)
                <strong>{{ $property->suburb }}</strong>{{ isset($property->estate) && $property->estate ? ' (' . $property->estate . ')' : '' }}{{ $property->country ? ', ' . $property->country : '' }}
            @else
                {{ $property->location ?: 'Victoria/Queensland' }}
            @endif
        </div>

        
        
        <div class="card-features">
            <span class="card-feature-item" title="Bedrooms">
                <i class="fa-solid fa-bed"></i> {{ $property->bed ?? ($features['bed'] ?? 0) }}
            </span>
            <span class="card-feature-item" title="Bathrooms">
                <i class="fa-solid fa-bath"></i> {{ $property->bath ?? ($features['bath'] ?? 0) }}
            </span>
            <span class="card-feature-item" title="Garage Spaces">
                <i class="fa-solid fa-car"></i> {{ $property->garage ?? ($features['parking'] ?? 0) }}
            </span>
            @if(isset($property->storeys) && $property->storeys)
                <span class="card-feature-item" title="Storeys">
                    <i class="fa-solid fa-layer-group"></i> {{ $property->storeys }}
                </span>
            @endif
        </div>
        
        <div class="card-actions">
            <a href="{{ $detailUrl }}" class="btn-secondary">View Package</a>
            <!-- <a href="{{ $detailUrl }}#enquire" class="btn-enquire-package">Enquire</a> -->
        </div>
    </div>
</div>
