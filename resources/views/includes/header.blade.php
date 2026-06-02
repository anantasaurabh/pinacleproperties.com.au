<header>
    <div class="container">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('assets/images/pinnacle-property-groups.png') }}" alt="Logo">
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
                    <li><a href="/house-and-land-packages">House & Land Packages</a></li>
                    <li><a href="/refer-a-friend">Refer a Friend</a></li>
                    <li><a href="/#about">About Us</a></li>
                    <li><a href="/#contact">Contact</a></li>
                @endisset
            </ul>
        </nav>
        <div class="mobile-menu" id="mobile-menu">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>
