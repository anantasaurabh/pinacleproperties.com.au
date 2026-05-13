<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @isset($page)
        <title>{{ $page->meta_title ?? $page->title }} - Pinnacle Home & Investment</title>
        <meta name="description" content="{{ $page->meta_description ?? '' }}">
        <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @else
        <title>Pinnacle Home & Investment</title>
    @endisset
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('assets/images/pinnacle-logo.png') }}?v=1" alt="Logo">
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    @isset($headerNav)
                        @foreach($headerNav as $nav)
                            <li><a href="{{ $nav->link }}" target="{{ $nav->target }}">{{ $nav->label }}</a></li>
                        @endforeach
                    @else
                        <li><a href="/">Home</a></li>
                        <li><a href="/services">Services</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                    @endisset
                </ul>
            </nav>
            <div class="header-actions">
                <a href="https://wa.me/611300000000" target="_blank" class="btn-call">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp <strong>1300 000 000</strong>
                </a>
                <div class="menu-toggle" id="mobile-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
