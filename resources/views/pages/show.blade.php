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
@foreach($page->sections->where('is_active', true) as $section)
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
                    {!! $section->content !!}
                </div>
            @endif

            {{-- BLOCKS --}}
            @if($section->blocks->where('is_active', true)->count())
                @php
                    $cols = $section->blocks->first()->columns_per_row ?? 3;
                    $gridClass = "grid-cols-{$cols}";
                @endphp
                <div class="blocks-grid {{ $gridClass }}">
                    @foreach($section->blocks->where('is_active', true) as $block)
                        <div class="block-card">
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
                                <p>{{ $block->content }}</p>
                            @endif
                            @if($block->button_text && $block->button_link)
                                <a href="{{ $block->button_link }}" class="btn-outline">{{ $block->button_text }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
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
