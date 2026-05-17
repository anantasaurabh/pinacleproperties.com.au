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
        <title>@yield('title', 'Pinnacle Home & Investment')</title>
    @endisset
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body>
    @include('includes.header')

    <main>
        @yield('content')
    </main>
    @include('sections.cta')
    @include('includes.footer')

    <script>
        const mobileMenu = document.getElementById('mobile-menu');
        const navLinks = document.querySelector('nav');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = mobileMenu.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-xmark');
        });

        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                const icon = mobileMenu.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-xmark');
            });
        });
    </script>
    <script src="{{ asset('js/forms.js') }}?v={{ time() }}"></script>
    @stack('scripts')
</body>
</html>
