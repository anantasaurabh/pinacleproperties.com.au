@extends('layouts.app')

@section('content')
{{-- HERO SECTION --}}
@if($page->hero && $page->hero->is_active)
    <section class="hero-section page-hero" @if($page->hero->image) style="background-image: url('{{ Str::startsWith($page->hero->image, 'http') ? $page->hero->image : asset('storage/' . $page->hero->image) }}')" @endif>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                @if($page->hero->title)
                    <h1>{{ $page->hero->title }}</h1>
                @endif
                @if($page->hero->subtitle)
                    <p>{{ $page->hero->subtitle }}</p>
                @endif
                @if($page->hero->buttons)
                    <div class="hero-buttons">
                        @foreach($page->hero->buttons as $btn)
                            <a href="{{ $btn['link'] }}" class="btn-primary">{{ $btn['text'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

{{-- PAGE SECTIONS --}}
@foreach($page->sections->where('is_active', true)->sortBy('sort_order') as $section)
    <section class="section page-section layout-{{ $section->layout }}">
        <div class="container">
            @if($section->kicker_text || $section->title || $section->lead_text)
                <div class="section-title">
                    @if($section->kicker_text)
                        <span>{{ strtoupper($section->kicker_text) }}</span>
                    @endif
                    @if($section->title)
                        <h2>{{ $section->title }}</h2>
                    @endif
                    @if($section->lead_text)
                        <p>{{ $section->lead_text }}</p>
                    @endif
                </div>
            @endif

            @if($section->content)
                <div class="section-content">
                    {!! App\Helpers\ShortcodeHelper::parse($section->content) !!}
                </div>
            @endif

            {{-- BLOCKS RENDERER --}}
            @if($section->blocks->where('is_active', true)->count())
                @php
                    $cols = $section->columns_per_row ?? 3;
                    $gridClass = $cols > 1 ? "grid-cols-{$cols}" : "grid-cols-full";
                    $blocks = $section->blocks->where('is_active', true)->sortBy('sort_order');
                @endphp

                @switch($section->layout)
                    @case('faq')
                        <div class="faq-accordion">
                            @foreach($blocks as $block)
                                <div class="faq-item" x-data="{ open: false }">
                                    <div class="faq-question" @click="open = !open">
                                        <h4>{{ $block->title }}</h4>
                                        <i class="fa-solid" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </div>
                                    <div class="faq-answer" x-show="open" x-collapse x-cloak>
                                        <div class="block-text-content">
                                            {!! App\Helpers\ShortcodeHelper::parse($block->content) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break

                    @case('list')
                    @case('list-numbered')
                        <div class="blocks-list {{ $section->layout === 'list-numbered' ? 'numbered' : '' }}">
                            @foreach($blocks as $index => $block)
                                <div class="list-block-item shadow-hover">
                                    <div class="list-visual-wrap">
                                        @if($block->image)
                                            <div class="list-img">
                                                <img src="{{ asset('storage/' . $block->image) }}" alt="Icon">
                                            </div>
                                        @elseif($block->icon)
                                            <div class="list-icon"><i class="{{ $block->icon }}"></i></div>
                                        @endif
                                        <div class="vertical-bar"></div>
                                    </div>
                                    <div class="list-content">
                                        @if($block->title) <h4>{{ $block->title }}</h4> @endif
                                        <div class="block-text-content">{!! $block->content !!}</div>
                                    </div>
                                    @if($section->layout === 'list-numbered')
                                        <div class="bg-number">{{ sprintf('%02d', $index + 1) }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @break

                    @case('small-image')
                    @case('large-image')
                        <div class="blocks-image-layout {{ $section->layout }}">
                            @foreach($blocks as $block)
                                <div class="image-block-row">
                                    @if($block->image)
                                        <div class="image-col">
                                            <img src="{{ asset('storage/' . $block->image) }}" alt="{{ $block->title }}">
                                        </div>
                                    @endif
                                    <div class="text-col">
                                        @if($block->title) <h3>{{ $block->title }}</h3> @endif
                                        <div class="block-text-content">{!! $block->content !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break

                    @case('state-showcase')
                        <style>
                            .state-showcase-container {
                                display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 60px;
                                align-items: center;
                                margin: 40px 0;
                                padding: 20px 0;
                            }
                            @media (max-width: 991px) {
                                .state-showcase-container {
                                    grid-template-columns: 1fr !important;
                                    gap: 40px !important;
                                    margin: 20px 0 !important;
                                    padding: 20px 0 !important;
                                }
                                .state-showcase-info {
                                    order: 2 !important;
                                }
                                .state-showcase-media {
                                    order: 1 !important;
                                    margin-bottom: 20px !important;
                                }
                                .state-showcase-container h2 {
                                    font-size: 2rem !important;
                                }
                            }
                        </style>
                        <div class="state-showcase-layout">
                            @foreach($blocks as $index => $block)
                                @php
                                    preg_match_all('/<li>(.*?)<\/li>/i', $block->content, $matches);
                                    $pills = $matches[1] ?? [];
                                    $cleanContent = preg_replace('/<ul[^>]*>.*?<\/ul>/is', '', $block->content);
                                    
                                    $isQueensland = (stripos($section->title, 'Queensland') !== false) || (stripos($block->title, 'Queensland') !== false) || ($index % 2 !== 0);
                                    $badgeIcon = $block->icon ?: (!$isQueensland ? 'fa-solid fa-trophy' : 'fa-solid fa-medal');
                                    
                                    $badgeParts = explode('|', $block->button_text ?: 'Highlight | Featured');
                                    $badgeTitle = trim($badgeParts[0]);
                                    $badgeSubtitle = isset($badgeParts[1]) ? trim($badgeParts[1]) : 'Featured Region';
                                    
                                    $ctaLink = $block->button_link ?: '#';
                                    $ctaLabel = !$isQueensland ? 'View Victoria Packages' : 'View Queensland Packages';
                                @endphp
                                
                                <div class="state-showcase-container">
                                    @if(!$isQueensland)
                                        <!-- Image on Left, Content on Right -->
                                        <div class="state-showcase-media" style="position: relative; padding-bottom: 30px;">
                                            <div style="position: absolute; top: -30px; left: -30px; width: 180px; height: 180px; background: rgba(var(--secondary-color-rgb), 0.08); border-radius: 50%; z-index: 1;"></div>
                                            <img src="{{ Str::startsWith($block->image, 'http') ? $block->image : asset('storage/' . $block->image) }}" alt="{{ $block->title }}" style="width: 100%; max-height: 460px; object-fit: cover; border-radius: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); position: relative; z-index: 2; display: block;">
                                            
                                            <div style="position: absolute; bottom: 0; left: 10%; right: 10%; background: #fff; border-radius: 20px; padding: 18px 25px; display: flex; align-items: center; gap: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); z-index: 3; border: 1px solid #f1f5f9;">
                                                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.25rem;">
                                                    <i class="{{ $badgeIcon }}"></i>
                                                </div>
                                                <div>
                                                    <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: var(--primary-color);">{{ $badgeTitle }}</h4>
                                                    <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 600;">{{ $badgeSubtitle }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="state-showcase-info" style="font-family: var(--font-family);">
                                        <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--secondary-color); margin-bottom: 15px; display: block;">
                                            {{ !$isQueensland ? 'YOUR FUTURE SANCTUARY' : 'SUNSHINE STATE LIFESTYLE' }}
                                        </span>
                                        <h2 style="font-size: 2.6rem; font-weight: 850; color: var(--primary-color); margin: 0 0 25px 0; line-height: 1.15; letter-spacing: -1px;">
                                            {{ $block->title }}
                                        </h2>
                                        
                                        <div class="state-showcase-text" style="font-size: 1rem; color: #64748b; line-height: 1.7; margin-bottom: 30px;">
                                            {!! $cleanContent !!}
                                        </div>
                                        
                                        @if(count($pills))
                                            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 40px;">
                                                @foreach($pills as $pill)
                                                    @php
                                                        $pillIcon = 'fa-solid fa-star';
                                                        if (stripos($pill, 'school') !== false) $pillIcon = 'fa-solid fa-graduation-cap';
                                                        if (stripos($pill, 'park') !== false || stripos($pill, 'green') !== false) $pillIcon = 'fa-solid fa-tree';
                                                        if (stripos($pill, 'family') !== false) $pillIcon = 'fa-solid fa-people-roof';
                                                        if (stripos($pill, 'sun') !== false || stripos($pill, 'weather') !== false) $pillIcon = 'fa-solid fa-sun';
                                                        if (stripos($pill, 'active') !== false || stripos($pill, 'outdoor') !== false) $pillIcon = 'fa-solid fa-person-running';
                                                        if (stripos($pill, 'estate') !== false || stripos($pill, 'masterplanned') !== false) $pillIcon = 'fa-solid fa-sitemap';
                                                    @endphp
                                                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 30px; padding: 12px 24px; display: flex; align-items: center; gap: 10px; font-size: 0.9rem; font-weight: 700; color: var(--primary-color); box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: all 0.3s;" onmouseover="this.style.borderColor='var(--secondary-color)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                                                        <i class="{{ $pillIcon }}" style="color: var(--secondary-color);"></i> {{ $pill }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        @if(isset($page) && $page->slug === 'home-buyers')
                                            <div>
                                                <a href="{{ $ctaLink }}" style="display: inline-flex; align-items: center; gap: 10px; background: var(--primary-color); color: #fff; text-decoration: none; padding: 16px 36px; border-radius: 30px; font-weight: 700; font-size: 0.95rem; transition: background 0.3s; box-shadow: 0 6px 20px rgba(15,81,50,0.15);" onmouseover="this.style.background='#0f4125';" onmouseout="this.style.background='var(--primary-color)';">
                                                    <span>{{ $ctaLabel }}</span>
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    @if($isQueensland)
                                        <!-- Image on Right, Content on Left -->
                                        <div class="state-showcase-media" style="position: relative; padding-bottom: 30px;">
                                            <div style="position: absolute; top: -30px; right: -30px; width: 180px; height: 180px; background: rgba(var(--secondary-color-rgb), 0.08); border-radius: 50%; z-index: 1;"></div>
                                            <img src="{{ Str::startsWith($block->image, 'http') ? $block->image : asset('storage/' . $block->image) }}" alt="{{ $block->title }}" style="width: 100%; max-height: 460px; object-fit: cover; border-radius: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); position: relative; z-index: 2; display: block;">
                                            
                                            <div style="position: absolute; bottom: 0; left: 10%; right: 10%; background: #fff; border-radius: 20px; padding: 18px 25px; display: flex; align-items: center; gap: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); z-index: 3; border: 1px solid #f1f5f9;">
                                                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.25rem;">
                                                    <i class="{{ $badgeIcon }}"></i>
                                                </div>
                                                <div>
                                                    <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: var(--primary-color);">{{ $badgeTitle }}</h4>
                                                    <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 600;">{{ $badgeSubtitle }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @break

                    @case('process')
                        <style>
                            .steps-process-grid {
                                display: grid;
                                grid-template-columns: repeat({{ count($blocks) }}, 1fr);
                                gap: 24px;
                                margin: 40px 0;
                            }
                            .process-step-card {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                text-align: center;
                                gap: 15px;
                                padding: 40px 25px;
                                background: #fff;
                                border-radius: 20px;
                                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                                border: 1px solid rgba(69, 112, 64, 0.1);
                                transition: all 0.3s ease;
                                position: relative;
                                overflow: hidden;
                            }
                            .process-step-card:hover {
                                transform: translateY(-5px);
                                border-color: var(--primary-color-light);
                                box-shadow: 0 15px 40px rgba(var(--primary-color-rgb), 0.12);
                            }
                            .process-step-icon {
                                flex: 0 0 80px;
                                height: 80px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-bottom: 4px solid #c3d3c4;
                                margin-bottom: 10px;
                                zoom: 1.5;
                                padding-bottom: 5px;
                            }
                            .process-step-icon img {
                                max-height: 100%;
                                width: auto;
                                object-fit: contain;
                            }
                            .process-step-icon i {
                                font-size: 1.85rem;
                                color: var(--primary-color);
                            }
                            .process-step-number {
                                position: absolute;
                                top: 12px;
                                right: 18px;
                                font-size: 2.8rem;
                                font-weight: 900;
                                color: rgba(var(--primary-color-dark-rgb), 0.06);
                                line-height: 1;
                                z-index: 0;
                                pointer-events: none;
                            }
                            .process-step-content {
                                flex: 1;
                                position: relative;
                                z-index: 1;
                            }
                            .process-step-content h4 {
                                color: var(--primary-color);
                                font-size: 1.25rem;
                                margin-bottom: 12px;
                                font-weight: 700;
                            }
                            .process-step-content div {
                                color: #64748b;
                                font-size: 0.92rem;
                                line-height: 1.6;
                            }
                            @media (max-width: 991px) {
                                .steps-process-grid {
                                    grid-template-columns: 1fr !important;
                                    gap: 30px !important;
                                    margin: 20px 0 !important;
                                }
                            }
                        </style>
                        <div class="steps-process-grid">
                            @foreach($blocks as $index => $block)
                                <div class="process-step-card">
                                    <div class="process-step-number">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </div>
                                    
                                    @if($block->image || $block->icon)
                                        <div class="process-step-icon">
                                            @if($block->image)
                                                @php
                                                    $imageSrc = Str::startsWith($block->image, 'assets') || Str::startsWith($block->image, 'http')
                                                        ? asset($block->image)
                                                        : asset('storage/' . $block->image);
                                                @endphp
                                                <img src="{{ $imageSrc }}" alt="{{ $block->title ?? '' }}">
                                            @elseif($block->icon)
                                                <i class="{{ $block->icon }}"></i>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div class="process-step-content">
                                        @if($block->title)
                                            <h4>{{ $block->title }}</h4>
                                        @endif
                                        @if($block->content)
                                            <div>
                                                {!! App\Helpers\ShortcodeHelper::parse($block->content) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break

                    @case('plain-grid')
                        <div class="blocks-grid {{ $gridClass }} plain-layout">
                            @foreach($blocks as $block)
                                <div class="block-plain">
                                    @if($block->title)
                                        <h4 class="plain-title">{{ $block->title }}</h4>
                                    @endif
                                    <div class="block-text-content">
                                        {!! App\Helpers\ShortcodeHelper::parse($block->content) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break

                    @default
                        <div class="blocks-grid {{ $gridClass }}">
                            @foreach($blocks as $block)
                                <div class="block-card @if($cols == 1) block-full-width @endif">
                                    @if($block->image)
                                        <div class="block-img">
                                            <img src="{{ Str::startsWith($block->image, 'http') ? $block->image : asset('storage/' . $block->image) }}" alt="{{ $block->title ?? '' }}">
                                        </div>
                                    @endif
                                    @if($block->icon)
                                        <div class="block-icon"><i class="{{ $block->icon }}"></i></div>
                                    @endif
                                    @if($block->title)
                                        <h4>{{ $block->title }}</h4>
                                    @endif
                                    @if($block->content)
                                        <div class="block-text-content">
                                            {!! App\Helpers\ShortcodeHelper::parse($block->content) !!}
                                        </div>
                                    @endif
                                    @if($block->button_text && $block->button_link)
                                        <a href="{{ $block->button_link }}" class="btn-outline">{{ $block->button_text }}</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                @endswitch
            @endif

            {{-- SECTION LINKS --}}
            @if($section->links && count($section->links))
                <div class="section-links" style="text-align:center; margin-top:40px;">
                    @foreach($section->links as $link)
                        <a href="{{ $link['link'] }}" class="btn-primary" style="margin: 0 8px;">{{ $link['text'] }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endforeach

{{-- CTA SECTION --}}
@if($page->cta && $page->cta->is_active)
    <section class="cta-section section">
        <div class="container">
            <div class="cta-content">
                @if($page->cta->image)
                    <div class="cta-image">
                        <img src="{{ Str::startsWith($page->cta->image, 'http') ? $page->cta->image : asset('storage/' . $page->cta->image) }}" alt="CTA">
                    </div>
                @endif
                <div class="cta-text">
                    @if($page->cta->title) <h2>{{ $page->cta->title }}</h2> @endif
                    @if($page->cta->subtitle) <p>{{ $page->cta->subtitle }}</p> @endif
                    @if($page->cta->buttons)
                        <div class="cta-buttons">
                            @foreach($page->cta->buttons as $btn)
                                <a href="{{ $btn['link'] }}" class="btn-primary">{{ $btn['text'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
