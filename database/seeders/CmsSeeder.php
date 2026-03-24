<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavItem;
use App\Models\Page;
use App\Models\PageHero;
use App\Models\PageSection;
use App\Models\PageBlock;
use App\Models\PageCta;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // ── NAVIGATION ────────────────────────────────────────────
        $headerNav = [
            ['label' => 'Home',        'link' => '/',           'location' => 'header', 'sort_order' => 1],
            ['label' => 'Properties',  'link' => '/properties', 'location' => 'header', 'sort_order' => 2],
            ['label' => 'Services',    'link' => '/services',   'location' => 'header', 'sort_order' => 3],
            ['label' => 'About',       'link' => '/about',      'location' => 'header', 'sort_order' => 4],
            ['label' => 'Contact',     'link' => '/contact',    'location' => 'header', 'sort_order' => 5],
        ];
        $footerQuick = [
            ['label' => 'About MPG',          'link' => '/about',            'location' => 'footer_quick_links', 'sort_order' => 1],
            ['label' => 'Properties',         'link' => '/properties',       'location' => 'footer_quick_links', 'sort_order' => 2],
            ['label' => 'Join our Network',   'link' => '/contact',          'location' => 'footer_quick_links', 'sort_order' => 3],
            ['label' => 'Services',           'link' => '/services',         'location' => 'footer_quick_links', 'sort_order' => 4],
        ];
        $footerCompany = [
            ['label' => 'Our Story',       'link' => '/about',   'location' => 'footer_company', 'sort_order' => 1],
            ['label' => 'Privacy Policy',  'link' => '/privacy', 'location' => 'footer_company', 'sort_order' => 2],
            ['label' => 'Contact Us',      'link' => '/contact', 'location' => 'footer_company', 'sort_order' => 3],
        ];

        foreach (array_merge($headerNav, $footerQuick, $footerCompany) as $item) {
            NavItem::create(array_merge($item, ['target' => '_self', 'is_active' => true]));
        }

        // ── ABOUT PAGE ────────────────────────────────────────────
        $about = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'meta_title' => 'About Melbourne Property Group',
            'meta_description' => 'Learn more about Melbourne Property Group – a premium real estate network connecting buyers, developers and investors.',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        PageHero::create([
            'page_id' => $about->id,
            'title' => 'About Melbourne Property Group',
            'subtitle' => 'Australia\'s trusted premium property referral network.',
            'buttons' => [['text' => 'Contact Us', 'link' => '/contact']],
            'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1600&q=80',
            'is_active' => true,
        ]);
        $s1 = PageSection::create([
            'page_id' => $about->id,
            'kicker_text' => 'WHO WE ARE',
            'title' => 'A New Standard in Property Services',
            'lead_text' => 'Melbourne Property Group is built on integrity, expertise, and delivering exceptional outcomes.',
            'content' => '<p>Founded with a vision to transform how Australians access premium real estate, MPG connects discerning buyers with certified developers and vetted build partners across Victoria and Queensland.</p><p>Our referral network spans residential, commercial, and off-plan developments, giving our clients access to opportunities typically reserved for the insider market.</p>',
            'layout' => 'large-image',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        PageSection::create([
            'page_id' => $about->id,
            'kicker_text' => 'OUR VALUES',
            'title' => 'What Drives Us',
            'layout' => 'grid',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        $valuesSection = PageSection::where('page_id', $about->id)->where('sort_order', 2)->first();
        foreach ([
            ['title' => 'Transparency', 'content' => 'We disclose all referral rewards and fee structures upfront.', 'icon' => 'fa-solid fa-eye', 'columns_per_row' => 3],
            ['title' => 'Excellence', 'content' => 'We partner only with licensed professionals and vetted developers.', 'icon' => 'fa-solid fa-star', 'columns_per_row' => 3],
            ['title' => 'Integrity', 'content' => 'Every recommendation is made in the best interest of our clients.', 'icon' => 'fa-solid fa-handshake', 'columns_per_row' => 3],
        ] as $i => $block) {
            PageBlock::create(array_merge($block, ['section_id' => $valuesSection->id, 'sort_order' => $i, 'is_active' => true]));
        }
        PageCta::create([
            'page_id' => $about->id,
            'title' => 'Join Our Network Today',
            'subtitle' => 'Partner with the most trusted name in Australian premium real estate.',
            'buttons' => [['text' => 'Get in Touch', 'link' => '/contact']],
            'is_active' => true,
        ]);

        // ── SERVICES PAGE ─────────────────────────────────────────
        $services = Page::create([
            'title' => 'Our Services',
            'slug' => 'services',
            'meta_title' => 'Property Services – Melbourne Property Group',
            'meta_description' => 'Explore the full range of property acquisition, investment strategy, and development management services.',
            'is_active' => true,
            'sort_order' => 2,
        ]);
        PageHero::create([
            'page_id' => $services->id,
            'title' => 'Tailored Property Solutions',
            'subtitle' => 'From acquisition to development — we guide you every step of the way.',
            'buttons' => [['text' => 'Get Started', 'link' => '/contact']],
            'image' => 'https://images.unsplash.com/photo-1460317442991-0ec209397118?auto=format&fit=crop&w=1600&q=80',
            'is_active' => true,
        ]);
        $servicesList = PageSection::create([
            'page_id' => $services->id,
            'kicker_text' => 'OUR EXPERTISE',
            'title' => 'What We Offer',
            'layout' => 'grid',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        foreach ([
            ['title' => 'Property Acquisition', 'content' => 'Expert guidance on securing premium residential and commercial properties across Australia.', 'icon' => 'fa-solid fa-house-chimney', 'columns_per_row' => 3],
            ['title' => 'Investment Strategy', 'content' => 'Data-driven insights and tailored recommendations to grow your property portfolio.', 'icon' => 'fa-solid fa-chart-line', 'columns_per_row' => 3],
            ['title' => 'Development Management', 'content' => 'End-to-end project management for residential and mixed-use developments.', 'icon' => 'fa-solid fa-building', 'columns_per_row' => 3],
            ['title' => 'Referral Network', 'content' => 'Access to Australia\'s most comprehensive network of verified developers and professionals.', 'icon' => 'fa-solid fa-users', 'columns_per_row' => 3],
            ['title' => 'Interstate Partnerships', 'content' => 'Seamlessly navigate opportunities across VIC and QLD with our interstate specialists.', 'icon' => 'fa-solid fa-map-location-dot', 'columns_per_row' => 3],
            ['title' => 'Due Diligence', 'content' => 'Rigorous vetting and research for every opportunity before it reaches our clients.', 'icon' => 'fa-solid fa-magnifying-glass', 'columns_per_row' => 3],
        ] as $i => $block) {
            PageBlock::create(array_merge($block, ['section_id' => $servicesList->id, 'sort_order' => $i, 'is_active' => true]));
        }
        PageCta::create([
            'page_id' => $services->id,
            'title' => 'Ready to find your next property?',
            'subtitle' => 'Let our experts guide you to the right investment.',
            'buttons' => [['text' => 'Contact Us', 'link' => '/contact'], ['text' => 'View Properties', 'link' => '/properties']],
            'is_active' => true,
        ]);

        // ── CONTACT PAGE ──────────────────────────────────────────
        $contact = Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact',
            'meta_title' => 'Contact Melbourne Property Group',
            'meta_description' => 'Get in touch with the Melbourne Property Group team. We are happy to answer your questions.',
            'is_active' => true,
            'sort_order' => 3,
        ]);
        PageHero::create([
            'page_id' => $contact->id,
            'title' => 'Get In Touch',
            'subtitle' => 'Our team is here to answer any questions about properties, partnerships, or investments.',
            'image' => 'https://images.unsplash.com/photo-1582408921715-18e7806365c1?auto=format&fit=crop&w=1600&q=80',
            'is_active' => true,
        ]);
        PageSection::create([
            'page_id' => $contact->id,
            'kicker_text' => 'CONTACT US',
            'title' => 'How Can We Help?',
            'lead_text' => 'Fill out the form below or reach us directly. We typically respond within one business day.',
            'content' => '<p>📧 Email: <a href="mailto:info@melbournepropertygroup.com.au">info@melbournepropertygroup.com.au</a></p><p>📞 Phone: <a href="tel:1300000000">1300 000 000</a></p><p>📍 Address: Level 10, 123 Collins Street, Melbourne VIC 3000</p>',
            'layout' => 'grid',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
