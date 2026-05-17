@extends('layouts.app')

@section('content')
<section class="property-detail-header" style="position: relative; overflow: hidden; height: 500px; display: flex; align-items: flex-end; padding-bottom: 60px;">
    <div class="hero-slideshow" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        @if($property->images && count($property->images) > 0)
            @foreach($property->images as $index => $galImage)
                @php $slideImg = Str::startsWith($galImage, 'http') ? $galImage : asset('storage/' . $galImage); @endphp
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $slideImg }}'); position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; opacity: 0; transition: opacity 1.5s cubic-bezier(0.4, 0, 0.2, 1); z-index: 1;"></div>
            @endforeach
        @else
            @php $slideImg = Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image); @endphp
            <div class="hero-slide active" style="background-image: url('{{ $slideImg }}'); position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; opacity: 1; z-index: 1;"></div>
        @endif
    </div>
    <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 60%, rgba(0, 0, 0, 0.1) 100%); z-index: 2;"></div>
    <div class="container" style="position: relative; z-index: 3;">
        <div class="property-header-content">
            <span class="card-tag">{{ $property->country ?: 'VIC/QLD' }}</span>
            <h1 style="color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.3); margin-top: 10px;">{{ $property->title }}</h1>
            <div class="property-meta" style="color: rgba(255,255,255,0.9); font-weight: 500; display: flex; gap: 25px; margin-top: 20px; font-size: 15px;">
                <span><i class="fa-solid fa-location-dot" style="color: var(--secondary-color);"></i> {{ $property->address ?: ($property->suburb ? $property->suburb . ($property->estate ? ' (' . $property->estate . ')' : '') : $property->location) }}</span>
                <span><i class="fa-solid fa-tag" style="color: var(--secondary-color);"></i> {{ $property->price_range ?: ($property->price ? '$' . number_format($property->price) : 'Contact Agent') }}</span>
                <span><i class="fa-solid fa-circle-check" style="color: var(--secondary-color);"></i> {{ $property->status }}</span>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top: 40px;">
    <div class="container">
        <!-- High-Visibility Headline Block (Nested within same section container) -->
        <div class="property-white-header" style="margin-bottom: 35px; border-bottom: 1px solid #e2e8f0; padding-bottom: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                <div>
                    <span style="background: var(--primary-color); color: #fff; padding: 5px 12px; border-radius: 6px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ $property->country ?: 'VIC/QLD' }}</span>
                    <h2 style="font-size: 2.25rem; color: var(--primary-color); font-weight: 800; margin: 12px 0 6px 0; font-family: var(--font-family); letter-spacing: -0.5px;">{{ $property->title }}</h2>
                    <p style="color: #64748b; font-size: 1.05rem; font-weight: 500; display: flex; align-items: center; gap: 8px; margin: 0;">
                        <i class="fa-solid fa-location-dot" style="color: var(--secondary-color); font-size: 1.15rem;"></i>
                        {{ $property->address ?: ($property->suburb ? $property->suburb . ($property->estate ? ' (' . $property->estate . ')' : '') : $property->location) }}
                    </p>
                </div>
                <div style="text-align: right; min-width: 220px;">
                    <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: #94a3b8; letter-spacing: 1px; display: block; margin-bottom: 4px;">Package Price</span>
                    <span style="font-size: 2.25rem; font-weight: 800; color: var(--secondary-color); display: block; line-height: 1;">
                        {{ $property->price_range ?: ($property->price ? '$' . number_format($property->price) : 'Contact Agent') }}
                    </span>
                    <span style="display: inline-block; margin-top: 10px; background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">
                        <i class="fa-solid fa-circle-check"></i> {{ $property->status }}
                    </span>
                </div>
            </div>
        </div>

        <div class="property-grid">
            <div class="property-main">
                <div class="property-card-large" style="box-shadow: none; border: none; background: transparent; padding: 0;">
                    
                    <div class="property-gallery-slider" style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-bottom: 35px; background: #f1f5f9;">
                        <div class="slider-viewport" style="display: flex; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); width: 100%; height: 500px;">
                            @if($property->images && count($property->images) > 0)
                                @foreach($property->images as $galImage)
                                    @php $slideImg = Str::startsWith($galImage, 'http') ? $galImage : asset('storage/' . $galImage); @endphp
                                    <div class="slide-item" style="min-width: 100%; height: 100%; position: relative;">
                                        <img src="{{ $slideImg }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            @elseif($property->image)
                                @php $slideImg = Str::startsWith($property->image, 'http') ? $property->image : asset('storage/' . $property->image); @endphp
                                <div class="slide-item" style="min-width: 100%; height: 100%; position: relative;">
                                    <img src="{{ $slideImg }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                        
                        @if($property->images && count($property->images) > 1)
                            <!-- Nav Arrows -->
                            <button class="slider-arrow prev" onclick="moveSlider(-1)" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.9); border: none; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 1.1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 5; transition: all 0.3s; outline: none;" onmouseover="this.style.background='#fff'; this.style.transform='translateY(-50%) scale(1.05)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='translateY(-50%) scale(1)'"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="slider-arrow next" onclick="moveSlider(1)" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.9); border: none; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-size: 1.1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 5; transition: all 0.3s; outline: none;" onmouseover="this.style.background='#fff'; this.style.transform='translateY(-50%) scale(1.05)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='translateY(-50%) scale(1)'"><i class="fa-solid fa-chevron-right"></i></button>
                            
                            <!-- Dots -->
                            <div class="slider-dots" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5; background: rgba(0,0,0,0.25); padding: 6px 12px; border-radius: 20px; backdrop-filter: blur(4px);">
                                @foreach($property->images as $index => $galImage)
                                    <span class="slider-dot {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.5); cursor: pointer; transition: all 0.3s;"></span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="property-description">
                        <h3>Description</h3>
                        <div class="content">
                            {!! nl2br(e($property->description ?: $property->short_description)) !!}
                        </div>
                    </div>

                    <div class="property-features-large">
                        <h3>Package Specifications</h3>
                        @php $features = json_decode($property->features, true) ?? []; @endphp
                        <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div class="feature-item">
                                <i class="fa-solid fa-bed"></i>
                                <span><strong>{{ $property->bed ?? ($features['bed'] ?? 0) }}</strong> Bedrooms</span>
                            </div>
                            <div class="feature-item">
                                <i class="fa-solid fa-bath"></i>
                                <span><strong>{{ $property->bath ?? ($features['bath'] ?? 0) }}</strong> Bathrooms</span>
                            </div>
                            <div class="feature-item">
                                <i class="fa-solid fa-car"></i>
                                <span><strong>{{ $property->garage ?? ($features['parking'] ?? 0) }}</strong> Garage Spaces</span>
                            </div>
                            @if($property->storeys)
                            <div class="feature-item">
                                <i class="fa-solid fa-layer-group"></i>
                                <span><strong>{{ $property->storeys }}</strong> Storey</span>
                            </div>
                            @endif
                            @if($property->area)
                            <div class="feature-item">
                                <i class="fa-solid fa-house-chimney"></i>
                                <span><strong>{{ $property->area }}</strong> Home Area</span>
                            </div>
                            @endif
                            @if($property->block_area)
                            <div class="feature-item">
                                <i class="fa-solid fa-ruler-combined"></i>
                                <span><strong>{{ $property->block_area }}</strong> Block Area</span>
                            </div>
                            @endif
                            @if($property->block_width)
                            <div class="feature-item">
                                <i class="fa-solid fa-arrows-left-right"></i>
                                <span><strong>{{ $property->block_width }}</strong> Block Width</span>
                            </div>
                            @endif
                            @if($property->block_depth)
                            <div class="feature-item">
                                <i class="fa-solid fa-arrows-up-down"></i>
                                <span><strong>{{ $property->block_depth }}</strong> Block Depth</span>
                            </div>
                            @endif
                            @if($property->estate)
                            <div class="feature-item">
                                <i class="fa-solid fa-tree"></i>
                                <span><strong>{{ $property->estate }}</strong> Estate</span>
                            </div>
                            @endif
                            @if($property->suburb)
                            <div class="feature-item">
                                <i class="fa-solid fa-map-pin"></i>
                                <span><strong>{{ $property->suburb }}</strong> Suburb</span>
                            </div>
                            @endif
                            @if($property->country)
                            <div class="feature-item">
                                <i class="fa-solid fa-map"></i>
                                <span><strong>{{ $property->country }}</strong> State</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($property->plan_image)
                        @php $planUrl = Str::startsWith($property->plan_image, 'http') ? $property->plan_image : asset('storage/' . $property->plan_image); @endphp
                        <div class="floor-plan-section" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 30px;">
                            <h3>Floor Plan</h3>
                            <div class="floor-plan-box" style="background: #fafafa; border: 1px dashed #ccc; border-radius: 16px; padding: 30px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; margin-top: 15px;">
                                <a href="{{ $planUrl }}" target="_blank" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; outline: none; text-decoration: none; cursor: pointer;">
                                    <img src="{{ $planUrl }}" alt="Floor Plan" style="max-width: 100%; max-height: 480px; object-fit: contain; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); background: #fff; padding: 15px; border: 1px solid #f1f5f9; display: block; margin: 0 auto; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.015)'" onmouseout="this.style.transform='scale(1)'">
                                    <p style="margin-top: 20px; color: #64748b; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 8px; justify-content: center; transition: color 0.3s;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='#64748b'"><i class="fa-solid fa-magnifying-glass-plus" style="color: var(--primary-color);"></i> Click to view floor plan in full screen</p>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($property->images && count($property->images) > 0)
                        <div class="package-gallery" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 30px;">
                            <h3>Photo Gallery</h3>
                            <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                                @foreach($property->images as $galImage)
                                    @php $galUrl = Str::startsWith($galImage, 'http') ? $galImage : asset('storage/' . $galImage); @endphp
                                    <div class="gallery-item" style="border-radius: 12px; overflow: hidden; height: 140px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee;">
                                        <a href="{{ $galUrl }}" target="_blank">
                                            <img src="{{ $galUrl }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="property-location" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 30px;">
                        <h3>Location Map</h3>
                        <p>{{ $property->address ?: ($property->suburb ? $property->suburb . ($property->estate ? ' (' . $property->estate . ')' : '') . ($property->country ? ', ' . $property->country : '') : $property->location) }}</p>
                        <div class="map-container" id="map" style="margin-top: 20px;">
                            @if($property->address || $property->location)
                                @php $mapAddress = urlencode($property->address ?: $property->location); @endphp
                                <div class="map-wrapper" style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; height: 450px;">
                                    <iframe 
                                        src="https://maps.google.com/maps?q={{ $mapAddress }}&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                                        width="100%" 
                                        height="100%" 
                                        style="border:0;" 
                                        allowfullscreen="" 
                                        loading="lazy">
                                    </iframe>
                                </div>
                            @else
                                <div class="map-placeholder" style="background: #f0f0f0; height: 450px; display: flex; align-items: center; justify-content: center; border-radius: 12px; flex-direction: column;">
                                    <i class="fa-solid fa-map-location-dot" style="font-size: 3rem; color: #ccc; margin-bottom: 10px;"></i>
                                    <p>Map view unavailable</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <aside class="property-sidebar" id="enquire">
                <div class="agent-info" style="background: rgba(var(--primary-color-rgb), 0.15); padding: 25px; border-radius: 20px; border: 1px solid rgba(var(--primary-color-rgb), 0.35); box-shadow: 0 4px 15px rgba(220,252,231,0.15); margin-bottom: 30px;">
                    @if($property->agent)
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div class="agent-avatar" style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; border: 2px solid var(--primary-color); flex-shrink: 0;">
                                @if($property->agent->image)
                                    <img src="{{ asset('storage/' . $property->agent->image) }}" alt="{{ $property->agent->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; background: rgba(var(--primary-color-rgb), 0.15); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.5rem;">
                                        {{ substr($property->agent->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="agent-details" style="flex-grow: 1;">
                                <h4 style="margin: 0; color: var(--primary-color); font-size: 1.05rem; font-weight: bold;">{{ $property->agent->name }}</h4>
                                <p style="margin: 3px 0 10px 0; font-size: 0.85rem; color: #666;">Pinnacle Property Advisor</p>
                                
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    @if($property->agent->phone)
                                        <a href="tel:{{ $property->agent->phone }}" style="color: #475569; font-weight: 500; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;">
                                            <i class="fa-solid fa-phone" style="color: var(--primary-color);"></i> {{ $property->agent->phone }}
                                        </a>
                                    @endif
                                    
                                    @if($property->agent->whatsapp)
                                        @php
                                            $cleanWa = preg_replace('/[^0-9]/', '', $property->agent->whatsapp);
                                            $waText = urlencode("Hi " . $property->agent->name . ", I'm interested in the House & Land package '" . $property->title . "' in " . ($property->suburb ?: $property->location) . ". Please send me more details.");
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanWa }}?text={{ $waText }}" target="_blank" style="background: var(--primary-color); color: #fff; font-weight: 600; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 8px 12px; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#22c55e'" onmouseout="this.style.background='#25d366'">
                                            <i class="fa-brands fa-whatsapp" style="font-size: 1.15rem;"></i> Message on WhatsApp
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div class="agent-avatar" style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; background: #e2e8f0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-solid fa-user-tie" style="font-size: 2.2rem; color: #64748b;"></i>
                            </div>
                            <div class="agent-details">
                                <h4 style="margin: 0; color: var(--primary-color); font-weight: bold;">Pinnacle Advisor</h4>
                                <p style="margin: 5px 0; font-size: 0.85rem; color: #666;">Pinnacle Home & Investment</p>
                                <a href="/contact" style="color: var(--primary-color); font-weight: 600; text-decoration: none; font-size: 0.85rem;">View Contact Details</a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="contact-card">
                    <h3 style="margin-bottom: 20px; color: var(--primary-color);">Enquire About This Package</h3>
                    @include('forms.inquiry', ['property' => $property])
                </div>

                @if($property->brochure_pdf)
                    <div class="brochure-download-card" style="margin-top: 30px; background: linear-gradient(135deg, var(--primary-color) 0%, #1e3a8a 100%); color: #fff; padding: 30px; border-radius: 20px; text-align: center; box-shadow: 0 10px 20px rgba(30,58,138,0.15);">
                        <i class="fa-solid fa-file-pdf" style="font-size: 2.5rem; margin-bottom: 15px; display: block; color: #fecdd3;"></i>
                        <h4 style="margin: 0 0 10px 0; font-size: 1.2rem; font-weight: bold; color: #fff;">Package Brochure</h4>
                        <p style="font-size: 0.9rem; margin-bottom: 20px; color: #e2e8f0; line-height: 1.4;">Download the comprehensive package brochure including inclusions list and premium specifications.</p>
                        <a href="{{ asset('storage/' . $property->brochure_pdf) }}" target="_blank" style="background: #fff; color: var(--primary-color); display: inline-block; width: 100%; padding: 12px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background 0.3s; text-align: center;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">
                            <i class="fa-solid fa-download"></i> Download PDF Brochure
                        </a>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@if(isset($suggested) && $suggested->count())
<section class="section bg-light">
    <div class="container">
        <div class="section-title">
            <span>EXPLORE MORE</span>
            <h2>Similar Packages</h2>
        </div>
        <div class="cards-grid">
            @foreach($suggested as $item)
                @include('properties.card', ['property' => $item])
            @endforeach
        </div>

        <!-- Premium SEO Geographical Sub-Links Block -->
        <div class="seo-geographical-links" style="margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 35px; text-align: center;">
            <p style="font-size: 0.85rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; font-family: var(--font-family);">Explore More House & Land Packages</p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; align-items: center;">
                @if($property->country)
                    @php $stateUrl = route('properties.state', ['country' => urlencode($property->country)]); @endphp
                    <a href="{{ $stateUrl }}" style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 24px; border-radius: 30px; font-size: 0.9rem; font-weight: 600; color: var(--primary-color); text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s; display: inline-flex; align-items: center;" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
                        <i class="fa-solid fa-map-location-dot" style="color: var(--secondary-color); margin-right: 8px;"></i> More houses in {{ $property->country }}
                    </a>
                @endif
                
                @if($property->country && $property->suburb)
                    @php 
                        $suburbSlug = urlencode(str_replace(' ', '-', $property->suburb));
                        $suburbUrl = route('properties.suburb', ['country' => urlencode($property->country), 'suburb' => $suburbSlug]); 
                    @endphp
                    <a href="{{ $suburbUrl }}" style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 24px; border-radius: 30px; font-size: 0.9rem; font-weight: 600; color: var(--primary-color); text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s; display: inline-flex; align-items: center;" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
                        <i class="fa-solid fa-location-dot" style="color: var(--secondary-color); margin-right: 8px;"></i> More houses in {{ $property->suburb }}
                    </a>
                @endif

                @if($property->country && $property->suburb && $property->estate)
                    @php 
                        $suburbSlug = urlencode(str_replace(' ', '-', $property->suburb));
                        $estateSlug = urlencode(str_replace(' ', '-', $property->estate));
                        $estateUrl = route('properties.estate', ['country' => urlencode($property->country), 'suburb' => $suburbSlug, 'estate' => $estateSlug]); 
                    @endphp
                    <a href="{{ $estateUrl }}" style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 24px; border-radius: 30px; font-size: 0.9rem; font-weight: 600; color: var(--primary-color); text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s; display: inline-flex; align-items: center;" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
                        <i class="fa-solid fa-tree-city" style="color: var(--secondary-color); margin-right: 8px;"></i> More houses in {{ $property->estate }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Hero Fading Slideshow
        const heroSlides = document.querySelectorAll('.hero-slideshow .hero-slide');
        if (heroSlides.length > 1) {
            let currentHero = 0;
            setInterval(() => {
                heroSlides[currentHero].style.opacity = '0';
                currentHero = (currentHero + 1) % heroSlides.length;
                heroSlides[currentHero].style.opacity = '1';
            }, 5000);
        }

        // 2. Main Photo Gallery Slider
        let currentMainSlide = 0;
        const viewport = document.querySelector('.slider-viewport');
        const dots = document.querySelectorAll('.slider-dot');
        const totalMainSlides = {{ ($property->images && count($property->images) > 0) ? count($property->images) : 1 }};

        window.moveSlider = function(direction) {
            currentMainSlide = (currentMainSlide + direction + totalMainSlides) % totalMainSlides;
            updateSliderPosition();
        }

        window.goToSlide = function(index) {
            currentMainSlide = index;
            updateSliderPosition();
        }

        function updateSliderPosition() {
            if (!viewport) return;
            viewport.style.transform = `translateX(-${currentMainSlide * 100}%)`;
            dots.forEach((dot, idx) => {
                if (idx === currentMainSlide) {
                    dot.style.background = '#fff';
                    dot.style.width = '20px';
                    dot.style.borderRadius = '5px';
                } else {
                    dot.style.background = 'rgba(255,255,255,0.5)';
                    dot.style.width = '8px';
                    dot.style.borderRadius = '50%';
                }
            });
        }

        if (dots.length > 0) {
            updateSliderPosition(); // set initial styles
        }
    });
</script>
@endsection
