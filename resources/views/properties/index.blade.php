@extends('layouts.app')

@section('content')
<style>
    /* Premium Filter Card and Slide-out Styles */
    .filter-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.07);
        border: 1px solid #f1f5f9;
        padding: 30px;
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }
    .filter-grid-primary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        align-items: flex-end;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
    }
    .filter-group label {
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 8px;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .filter-group input[type="text"], 
    .filter-group select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #fff;
        font-size: 0.9rem;
        font-weight: 500;
        color: #1e293b;
        transition: border-color 0.3s;
    }
    .filter-group input[type="text"]:focus, 
    .filter-group select:focus {
        border-color: var(--primary-color);
        outline: none;
    }
    
    /* Toggle Panel for More Filters */
    .btn-more-filters {
        background: #f8fafc;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        height: 46px;
    }
    .btn-more-filters:hover, .btn-more-filters.active {
        background: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
    }
    
    .more-filters-panel {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
    }
    .more-filters-inner {
        padding-top: 25px;
        margin-top: 25px;
        border-top: 1px dashed #e2e8f0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
    }

    /* Dual Range Sliders styling */
    .range-slider-group {
        display: flex;
        flex-direction: column;
    }
    .range-slider-group label {
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 12px;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .dual-slider-container {
        position: relative;
        width: 100%;
        height: 35px;
        margin-top: 5px;
    }
    .dual-slider-container .slider-track {
        position: absolute;
        width: 100%;
        height: 6px;
        background: #e2e8f0;
        border-radius: 3px;
        top: 15px;
        z-index: 1;
    }
    .dual-slider-container input[type="range"] {
        position: absolute;
        width: 100%;
        height: 6px;
        top: 15px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
        z-index: 2;
    }
    .dual-slider-container input[type="range"]::-webkit-slider-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        pointer-events: auto;
        -webkit-appearance: none;
        z-index: 3;
        transition: transform 0.15s;
    }
    .dual-slider-container input[type="range"]::-webkit-slider-thumb:hover {
        transform: scale(1.2);
    }
    .dual-slider-container input[type="range"]::-moz-range-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        pointer-events: auto;
        z-index: 3;
        transition: transform 0.15s;
    }
    .dual-slider-container input[type="range"]::-moz-range-thumb:hover {
        transform: scale(1.2);
    }

    @media (max-width: 992px) {
        .looking-more-grid {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
            padding: 35px 25px !important;
        }
    }
</style>

<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?auto=format&fit=crop&w=1920&q=80'); ">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1>House & Land Packages</h1>
            <p>Explore our curated collection of investment-grade house & land packages across QLD and VIC.</p>
        </div>
    </div>
</section>

<section class="section filter-section" style="background: #fdfdfd; padding-top: 0; padding-bottom: 50px;">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET" class="filter-form">
            <div class="filter-card">
                <!-- LEVEL 1: QUICK SEARCH (Visible by Default) -->
                <div class="filter-grid-primary">
                    <div class="filter-group">
                        <label for="search">Keyword Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Suburb, estate, keyword...">
                    </div>
                    
                    <div class="filter-group">
                        <label for="country">State</label>
                        <select name="country" id="country">
                            <option value="">All States</option>
                            <option value="QLD" {{ request('country') == 'QLD' ? 'selected' : '' }}>QLD</option>
                            <option value="VIC" {{ request('country') == 'VIC' ? 'selected' : '' }}>VIC</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="suburb">Suburb</label>
                        <select name="suburb" id="suburb">
                            <option value="">All Suburbs</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <button type="button" class="btn-more-filters" id="toggle-more-filters">
                            More Filters <i class="fa-solid fa-sliders" style="margin-left: 4px;"></i>
                        </button>
                    </div>

                    <div class="filter-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <button type="submit" class="btn-primary" style="height: 46px; font-weight: 700; border-radius: 10px;">Search</button>
                        <a href="{{ route('properties.index') }}" class="btn-outline" style="height: 46px; text-decoration: none; text-align: center; line-height: 20px; font-weight: 700; border-radius: 10px; display: flex; align-items: center; justify-content: center;">Reset</a>
                    </div>
                </div>

                <!-- LEVEL 2: EXPANDABLE MORE FILTERS (Collapsible Section) -->
                <div class="more-filters-panel" id="more-filters-panel">
                    <div class="more-filters-inner">
                        <!-- ROOMS SELECTORS (Upper Row) -->
                        <div class="filter-group">
                            <label for="bed"><i class="fa-solid fa-bed"></i> Bedrooms</label>
                            <select name="bed" id="bed">
                                <option value="">Any Beds</option>
                                <option value="2" {{ request('bed') == '2' ? 'selected' : '' }}>2 Bedrooms</option>
                                <option value="3" {{ request('bed') == '3' ? 'selected' : '' }}>3 Bedrooms</option>
                                <option value="4" {{ request('bed') == '4' ? 'selected' : '' }}>4 Bedrooms</option>
                                <option value="5" {{ request('bed') == '5' ? 'selected' : '' }}>5+ Bedrooms</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="bath"><i class="fa-solid fa-bath"></i> Bathrooms</label>
                            <select name="bath" id="bath">
                                <option value="">Any Baths</option>
                                <option value="1" {{ request('bath') == '1' ? 'selected' : '' }}>1 Bathroom</option>
                                <option value="2" {{ request('bath') == '2' ? 'selected' : '' }}>2 Bathrooms</option>
                                <option value="3" {{ request('bath') == '3' ? 'selected' : '' }}>3+ Bathrooms</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="garage"><i class="fa-solid fa-car"></i> Garages</label>
                            <select name="garage" id="garage">
                                <option value="">Any Garages</option>
                                <option value="1" {{ request('garage') == '1' ? 'selected' : '' }}>1 Space</option>
                                <option value="2" {{ request('garage') == '2' ? 'selected' : '' }}>2 Spaces</option>
                                <option value="3" {{ request('garage') == '3' ? 'selected' : '' }}>3+ Spaces</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="storeys"><i class="fa-solid fa-layer-group"></i> Storeys</label>
                            <select name="storeys" id="storeys">
                                <option value="">Any Storeys</option>
                                <option value="Single" {{ request('storeys') == 'Single' ? 'selected' : '' }}>Single Storey</option>
                                <option value="Double" {{ request('storeys') == 'Double' ? 'selected' : '' }}>Double Storey</option>
                            </select>
                        </div>

                        <!-- SLIDERS & ESTATE (Lower Row) -->
                        <!-- PRICE RANGE SLIDER (Dual thumbs) -->
                        <div class="range-slider-group">
                            <label><i class="fa-solid fa-dollar-sign"></i> Price Range</label>
                            <div class="dual-slider-container">
                                <div class="slider-track" id="price-track"></div>
                                <input type="range" min="150000" max="3000000" step="50000" value="{{ request('min_price', 150000) }}" id="min-price-slider">
                                <input type="range" min="150000" max="3000000" step="50000" value="{{ request('max_price', 3000000) }}" id="max-price-slider">
                            </div>
                            <div class="slider-displays">
                                <span id="min-price-display">$150,000</span>
                                <span id="max-price-display">$3,000,000+</span>
                            </div>
                            <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price') }}">
                            <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price') }}">
                        </div>

                        <!-- HOME AREA RANGE SLIDER (Dual thumbs) -->
                        <div class="range-slider-group">
                            <label><i class="fa-solid fa-house-chimney"></i> Home Area</label>
                            <div class="dual-slider-container">
                                <div class="slider-track" id="home-track"></div>
                                <input type="range" min="50" max="600" step="10" value="{{ request('min_home_area', 50) }}" id="min-home-slider">
                                <input type="range" min="50" max="600" step="10" value="{{ request('max_home_area', 600) }}" id="max-home-slider">
                            </div>
                            <div class="slider-displays">
                                <span id="min-home-display">50 sqm</span>
                                <span id="max-home-display">600 sqm+</span>
                            </div>
                            <input type="hidden" name="min_home_area" id="min_home_area" value="{{ request('min_home_area') }}">
                            <input type="hidden" name="max_home_area" id="max_home_area" value="{{ request('max_home_area') }}">
                        </div>

                        <!-- BLOCK AREA RANGE SLIDER (Dual thumbs) -->
                        <div class="range-slider-group">
                            <label><i class="fa-solid fa-ruler-combined"></i> Block / Land Area</label>
                            <div class="dual-slider-container">
                                <div class="slider-track" id="block-track"></div>
                                <input type="range" min="100" max="1500" step="20" value="{{ request('min_block_area', 100) }}" id="min-block-slider">
                                <input type="range" min="100" max="1500" step="20" value="{{ request('max_block_area', 1500) }}" id="max-block-slider">
                            </div>
                            <div class="slider-displays">
                                <span id="min-block-display">100 sqm</span>
                                <span id="max-block-display">1500 sqm+</span>
                            </div>
                            <input type="hidden" name="min_block_area" id="min_block_area" value="{{ request('min_block_area') }}">
                            <input type="hidden" name="max_block_area" id="max_block_area" value="{{ request('max_block_area') }}">
                        </div>

                        <!-- ESTATE DROPDOWN -->
                        <div class="filter-group">
                            <label for="estate"><i class="fa-solid fa-tree"></i> Estate</label>
                            <select name="estate" id="estate">
                                <option value="">All Estates</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section" style="padding-top: 0;">
    <div class="container">
        @if($properties->count())
            <div class="cards-grid">
                @foreach($properties as $property)
                    @include('properties.card')
                @endforeach
            </div>
            <div class="pagination-wrapper" style="margin-top: 50px;">
                {{ $properties->appends(request()->query())->links() }}
            </div>
        @else
            <div class="no-results" style="text-align: center; padding: 100px 0;">
                <i class="fa-solid fa-house-circle-exclamation" style="font-size: 4rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                <h3>No packages found</h3>
                <p>Try adjusting your search filters or resetting them to explore available packages.</p>
                <a href="{{ route('properties.index') }}" class="btn-primary" style="margin-top: 20px; display: inline-block; text-decoration: none;">Clear all filters</a>
            </div>
        @endif
    </div>
</section>

<!-- Premium "Looking for More" Custom Section -->
<section class="section" style="background: #f8fafc; padding: 60px 0;">
    <div class="container">
        
        <!-- "Looking for More" Form Header -->
        <div class="section-title" style="text-align: center; margin-bottom: 40px;">
            <span>Can't Find Your Dream Package?</span>
            <h2 style="font-size: 2.2rem; color: var(--primary-color); font-weight: 800; margin: 10px 0 15px 0; font-family: var(--font-family); letter-spacing: -0.5px;">Looking for More?</h2>
            <p class="lead" style="color: #64748b; font-size: 1.05rem; max-width: 800px; margin: 0 auto; line-height: 1.6; font-weight: 500;">If you didn’t find exactly what you’re looking, let us know below and one of our property advisor will be able to help.</p>
        </div>

        <!-- Side-by-Side Inquiry Grid -->
        <div class="inquiry-wrapper">
            <div class="inquiry-info">
                <div class="info-image">
                    <img src="{{ asset('assets/images/inquiry-builder-partner.png') }}" alt="Looking for More">
                </div>
                <div class="info-card urgency" style="background: #fff; border: 1px solid #e2e8f0; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                    <i class="fa-solid fa-handshake-angle" style="color: var(--primary-color); font-size: 1.8rem; margin-bottom: 15px;"></i>
                    <h3 style="font-size: 1.15rem; color: var(--primary-color); font-weight: 700; margin-bottom: 10px;">How We Help</h3>
                    <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0;">We work closely with some of the best developers and builders across Victoria and Queensland, assisting our community in achieving their dream of owning a brand-new house and land package or securing land for future development, subject to building conditions and package requirements.</p>
                </div>
                <div class="info-card urgency" style="background: #fff; border: 1px solid #e2e8f0; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); ">
                    <i class="fa-solid fa-house-chimney-window" style="color: var(--primary-color); font-size: 1.8rem; margin-bottom: 15px;"></i>
                    <h3 style="font-size: 1.15rem; color: var(--primary-color); font-weight: 700; margin-bottom: 10px;">The Pinnacle Advantage</h3>
                    <ul style="list-style: none; padding: 0; margin: 15px 0 0 0;">
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; font-size: 0.95rem; color: #64748b; line-height: 1.5;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>No-obligation consultation with expert property advisors</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; font-size: 0.95rem; color: #64748b; line-height: 1.5;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>Exclusive developer integrations for off-market packages</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; font-size: 0.95rem; color: #64748b; line-height: 1.5;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>Full end-to-end guidance from package curation to build hand-over</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="inquiry-form-container">
                @include('forms.inquiry_long')
            </div>
        </div>

        <!-- Quick State Navigation Links Badges (Moved After the Form) -->
        <div style="text-align: center; margin-top: 60px; padding-top: 40px; border-top: 1px solid #e2e8f0;">
            <p style="font-size: 0.85rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px; font-family: var(--font-family);">Quick State Search</p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="{{ route('properties.state', ['country' => 'VIC']) }}" style="background: #fff; border: 1px solid #e2e8f0; padding: 12px 28px; border-radius: 30px; font-size: 0.95rem; font-weight: 700; color: var(--primary-color); text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s; display: inline-flex; align-items: center;" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
                    <i class="fa-solid fa-map-location-dot" style="color: var(--secondary-color); margin-right: 8px;"></i> Houses in VIC
                </a>
                <a href="{{ route('properties.state', ['country' => 'QLD']) }}" style="background: #fff; border: 1px solid #e2e8f0; padding: 12px 28px; border-radius: 30px; font-size: 0.95rem; font-weight: 700; color: var(--primary-color); text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s; display: inline-flex; align-items: center;" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
                    <i class="fa-solid fa-map-location-dot" style="color: var(--secondary-color); margin-right: 8px;"></i> Houses in QLD
                </a>
            </div>
        </div>

    </div>
</section>

{{-- Dependent Dropdowns & Dual Thumbs JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ─────────────── 1. DEPENDENT DROPDOWNS SYSTEM ───────────────
    const locations = @json($locationsData);
    
    const stateSelect = document.getElementById('country');
    const suburbSelect = document.getElementById('suburb');
    const estateSelect = document.getElementById('estate');
    
    const selectedState = "{{ request('country') }}";
    const selectedSuburb = "{{ request('suburb') }}";
    const selectedEstate = "{{ request('estate') }}";
    
    function populateSuburbs() {
        const currentState = stateSelect.value;
        
        suburbSelect.innerHTML = '<option value="">All Suburbs</option>';
        estateSelect.innerHTML = '<option value="">All Estates</option>';
        
        let suburbs = [];
        
        if (currentState && locations[currentState]) {
            suburbs = Object.keys(locations[currentState]);
        } else {
            const allSuburbs = new Set();
            Object.keys(locations).forEach(state => {
                Object.keys(locations[state]).forEach(sub => {
                    allSuburbs.add(sub);
                });
            });
            suburbs = Array.from(allSuburbs);
        }
        
        suburbs.sort().forEach(suburb => {
            const option = document.createElement('option');
            option.value = suburb;
            option.textContent = suburb;
            if (suburb === selectedSuburb) {
                option.selected = true;
            }
            suburbSelect.appendChild(option);
        });
        
        populateEstates();
    }
    
    function populateEstates() {
        const currentState = stateSelect.value;
        const currentSuburb = suburbSelect.value;
        
        estateSelect.innerHTML = '<option value="">All Estates</option>';
        
        let estates = [];
        
        if (currentState && currentSuburb && locations[currentState] && locations[currentState][currentSuburb]) {
            estates = locations[currentState][currentSuburb];
        } else if (currentSuburb) {
            const allEstates = new Set();
            Object.keys(locations).forEach(state => {
                if (locations[state][currentSuburb]) {
                    locations[state][currentSuburb].forEach(est => {
                        allEstates.add(est);
                    });
                }
            });
            estates = Array.from(allEstates);
        } else if (currentState && locations[currentState]) {
            const allEstates = new Set();
            Object.keys(locations[currentState]).forEach(sub => {
                locations[currentState][sub].forEach(est => {
                    allEstates.add(est);
                });
            });
            estates = Array.from(allEstates);
        } else {
            const allEstates = new Set();
            Object.keys(locations).forEach(state => {
                Object.keys(locations[state]).forEach(sub => {
                    locations[state][sub].forEach(est => {
                        allEstates.add(est);
                    });
                });
            });
            estates = Array.from(allEstates);
        }
        
        estates.sort().forEach(estate => {
            const option = document.createElement('option');
            option.value = estate;
            option.textContent = estate;
            if (estate === selectedEstate) {
                option.selected = true;
            }
            estateSelect.appendChild(option);
        });
    }
    
    stateSelect.addEventListener('change', populateSuburbs);
    suburbSelect.addEventListener('change', populateEstates);
    
    populateSuburbs();
    
    if (selectedSuburb) {
        suburbSelect.value = selectedSuburb;
        populateEstates();
    }
    if (selectedEstate) {
        estateSelect.value = selectedEstate;
    }

    // ─────────────── 2. MORE FILTERS DRAWER COLLAPSIBLE ───────────────
    const toggleBtn = document.getElementById('toggle-more-filters');
    const panel = document.getElementById('more-filters-panel');
    const toggleIcon = toggleBtn.querySelector('i');

    function togglePanel() {
        if (panel.style.maxHeight === '0px' || panel.style.maxHeight === '') {
            panel.style.maxHeight = panel.scrollHeight + 'px';
            toggleBtn.classList.add('active');
            toggleBtn.style.background = 'var(--primary-color)';
            toggleBtn.style.color = '#fff';
        } else {
            panel.style.maxHeight = '0px';
            toggleBtn.classList.remove('active');
            toggleBtn.style.background = '#f8fafc';
            toggleBtn.style.color = '#475569';
        }
    }

    toggleBtn.addEventListener('click', togglePanel);

    // Keep panel expanded if advanced filters were already selected in URL
    const hasAdvancedFilters = "{{ request('min_price') || request('min_home_area') || request('min_block_area') || request('bed') || request('bath') || request('garage') }}";
    if (hasAdvancedFilters) {
        // Delay slightly for panel to compute layout correctly on load
        setTimeout(() => {
            panel.style.maxHeight = panel.scrollHeight + 'px';
            toggleBtn.classList.add('active');
            toggleBtn.style.background = 'var(--primary-color)';
            toggleBtn.style.color = '#fff';
        }, 100);
    }

    // ─────────────── 3. PREMIUM DUAL-THUMB RANGE SLIDERS ───────────────
    function initDualSlider(minSliderId, maxSliderId, trackId, minDisplayId, maxDisplayId, minHiddenId, maxHiddenId, isPrice = false, isArea = false) {
        const minSlider = document.getElementById(minSliderId);
        const maxSlider = document.getElementById(maxSliderId);
        const track = document.getElementById(trackId);
        const minDisplay = document.getElementById(minDisplayId);
        const maxDisplay = document.getElementById(maxDisplayId);
        const minHidden = document.getElementById(minHiddenId);
        const maxHidden = document.getElementById(maxHiddenId);

        const step = parseFloat(minSlider.step) || 1;
        const minGap = step * 2;

        function formatVal(val) {
            val = parseFloat(val);
            if (isPrice) {
                if (val >= 1000000) {
                    return '$' + (val / 1000000).toFixed(1) + 'M';
                }
                return '$' + val.toLocaleString();
            }
            if (isArea) {
                return val + ' sqm';
            }
            return val;
        }

        function setColors() {
            const percent1 = ((minSlider.value - minSlider.min) / (minSlider.max - minSlider.min)) * 100;
            const percent2 = ((maxSlider.value - minSlider.min) / (minSlider.max - minSlider.min)) * 100;
            
            // Connect track with a premium dark blue shade matching standard interfaces
            track.style.background = `linear-gradient(to right, #e2e8f0 ${percent1}%, #1e3a8a ${percent1}%, #1e3a8a ${percent2}%, #e2e8f0 ${percent2}%)`;
        }

        function updateMin() {
            if (parseFloat(maxSlider.value) - parseFloat(minSlider.value) <= minGap) {
                minSlider.value = parseFloat(maxSlider.value) - minGap;
            }
            minDisplay.textContent = formatVal(minSlider.value);
            minHidden.value = minSlider.value;
            setColors();
        }

        function updateMax() {
            if (parseFloat(maxSlider.value) - parseFloat(minSlider.value) <= minGap) {
                maxSlider.value = parseFloat(minSlider.value) + minGap;
            }
            maxDisplay.textContent = formatVal(maxSlider.value) + (parseFloat(maxSlider.value) === parseFloat(maxSlider.max) ? '+' : '');
            maxHidden.value = maxSlider.value;
            setColors();
        }

        minSlider.addEventListener('input', updateMin);
        maxSlider.addEventListener('input', updateMax);

        // Preload states
        updateMin();
        updateMax();
    }

    // Initialize all three sliders
    initDualSlider('min-price-slider', 'max-price-slider', 'price-track', 'min-price-display', 'max-price-display', 'min_price', 'max_price', true, false);
    initDualSlider('min-home-slider', 'max-home-slider', 'home-track', 'min-home-display', 'max-home-display', 'min_home_area', 'max_home_area', false, true);
    initDualSlider('min-block-slider', 'max-block-slider', 'block-track', 'min-block-display', 'max-block-display', 'min_block_area', 'max_block_area', false, true);
});
</script>
@endsection
