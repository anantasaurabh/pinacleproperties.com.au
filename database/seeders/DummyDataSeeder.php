<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opportunities = [
            ['title' => 'The Mansion Estate', 'location' => 'Toorak, Melbourne VIC', 'price_range' => '$2,400,000', 'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 4, 'bath' => 3, 'sqft' => '400m²']), 'short_description' => 'FOR SALE'],
            ['title' => 'Skyline Residences', 'location' => 'Docklands, Melbourne VIC', 'price_range' => '$1,820,000', 'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 3, 'bath' => 2, 'sqft' => '150m²']), 'short_description' => 'OFF PLAN'],
            ['title' => 'Heritage Court', 'location' => 'Kew, Melbourne VIC', 'price_range' => '$3,100,000', 'image' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 5, 'bath' => 4, 'sqft' => '550m²']), 'short_description' => 'PREMIUM'],
            ['title' => 'Ocean Point Villa', 'location' => 'Brighton, Melbourne VIC', 'price_range' => '$4,750,000', 'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 6, 'bath' => 5, 'sqft' => '720m²']), 'short_description' => 'EXCLUSIVE'],
            ['title' => 'Parkside Flats', 'location' => 'Northcote, Melbourne VIC', 'price_range' => '$1,150,800', 'image' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 2, 'bath' => 1, 'sqft' => '85m²']), 'short_description' => 'INVESTMENT'],
            ['title' => 'Colossal Manor', 'location' => 'Hawthorn, Melbourne VIC', 'price_range' => '$5,200,000', 'image' => 'https://images.unsplash.com/photo-1723110994499-df46435aa4b3?auto=format&fit=crop&w=600&q=80', 'features' => json_encode(['bed' => 7, 'bath' => 6, 'sqft' => '940m²']), 'short_description' => 'PORTFOLIO'],
        ];

        foreach ($opportunities as $opp) {
            \App\Models\Opportunity::create($opp);
        }

        $services = [
            ['title' => 'Property Acquisition', 'description' => 'Expert guidance on securing premium real estate assets.', 'icon' => 'fa-solid fa-house-chimney', 'type' => 'solution'],
            ['title' => 'Investment Strategy', 'description' => 'Data-driven insights to maximize your property investment returns.', 'icon' => 'fa-solid fa-chart-line', 'type' => 'solution'],
            ['title' => 'Development Mgmt', 'description' => 'End-to-end management for comprehensive development projects.', 'icon' => 'fa-solid fa-building', 'type' => 'solution'],
        ];

        foreach ($services as $srv) {
            \App\Models\Service::create($srv);
        }

        \App\Models\Post::create([
            'title' => 'Navigating the 2026 Melbourne Property Market',
            'slug' => 'navigating-2026',
            'category' => 'Market Insights',
            'read_time' => '5 MIN READ',
            'excerpt' => 'A comprehensive look at the key trends shaping Melbourne real estate this year.',
            'cover_image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80',
            'content' => 'Lorem ipsum dolor sit amet...'
        ]);
        \App\Models\Post::create([
            'title' => 'Top 5 Up-and-Coming Suburbs for Investors',
            'slug' => 'top-5-suburbs',
            'category' => 'Investment',
            'read_time' => '7 MIN READ',
            'excerpt' => 'Discover the regions showing the strongest potential for capital growth.',
            'cover_image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80',
            'content' => 'Lorem ipsum dolor sit amet...'
        ]);
        \App\Models\Post::create([
            'title' => 'Sustainable Developments: The New Standard',
            'slug' => 'sustainable-developments',
            'category' => 'Development',
            'read_time' => '4 MIN READ',
            'excerpt' => 'Why eco-friendly building practices are becoming mandatory for premium projects.',
            'cover_image' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=600&q=80',
            'content' => 'Lorem ipsum dolor sit amet...'
        ]);
    }
}
