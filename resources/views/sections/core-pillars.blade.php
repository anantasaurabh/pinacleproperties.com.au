<section class="section">
    <div class="container">
        <div class="section-title">
            <span>OUR SERVICES</span>
            <h2>Premium Real Estate Ecosystem</h2>
            <p class="lead text-muted">A comprehensive ecosystem designed to support every stage of your property journey.</p>
        </div>
        @php
        $pillars = [
            [
                'icon' => 'fa-solid fa-house',
                'title' => 'Home Buyers',
                'description' => "Find your dream community with our curated selection of Melbourne's most prestigious residences. We guide you through every step of the acquisition process with decades of expertise.",
                'benefits' => [
                    'Verified developers for peace of mind',
                    'Transparent, risk-free process',
                    'Support from licensed professionals',
                    'Nationwide property options',
                ],
                'image' => asset('assets/images/mpg-home-buyers.png'),
                'link' => '#',
                'link_label' => 'Find My Home'
            ],
            [
                'icon' => 'fa-solid fa-chart-line',
                'title' => 'Investors',
                'description' => 'Maximize returns with data-driven property insights and exclusive off-market opportunities. Our portfolio management services are designed for long-term wealth creation.',
                'benefits' => [
                    'Pre-vetted developers for safe investments',
                    'Transparent referral process and reporting',
                    'Access to Australia-wide investment properties',
                    'Expert guidance from accountants and brokers',
                ],
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'link' => '#',
                'link_label' => 'Explore Investments'
            ],
            [
                'icon' => 'fa-solid fa-handshake',
                'title' => 'Partners',
                'description' => "Collaborate with Melbourne's elite professional network. We bridge the gap between service providers and high-end property requirements in a value-driven alliance.",
                'benefits' => [
                    'Strengthen client relationships',
                    'Access verified developers and nationwide projects',
                    'Earn referral rewards transparently',
                    'Simple onboarding; low barrier to entry',
                ],
                'image' => asset('assets/images/mpg-partners.png'),
                'link' => '#',
                'link_label' => 'Join as a Partner'
            ],
            [
                'icon' => 'fa-solid fa-city',
                'title' => 'Developers',
                'description' => 'Streamline projects from site acquisition to final sales with our strategic expertise. We provide the connections needed to bring vision to reality.',
                'benefits' => [
                    'Pre-qualified, verified client leads',
                    'Access to nationwide partner network',
                    'Transparent, compliant introductions',
                    'Enhanced project visibility',
                ],
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80',
                'link' => '#',
                'link_label' => 'Apply to Partner as a Developer'
            ]
        ];
        @endphp

        @foreach ($pillars as $pillar)
            @include('sections.pillars.pillar-item', ['pillar' => $pillar])
        @endforeach
    </div>
</section>