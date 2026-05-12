<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $opportunities = \App\Models\Opportunity::where('is_featured', true)->get();
        $services = \App\Models\Service::all();
        $posts = \App\Models\Post::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();
        $settings = \App\Models\Setting::pluck('value', 'key');
        $headerNav     = \App\Models\NavItem::header()->get();
        $footerQuick   = \App\Models\NavItem::footerQuickLinks()->get();
        $footerCompany = \App\Models\NavItem::footerCompany()->get();

        return view('home', compact('opportunities', 'services', 'posts', 'settings', 'headerNav', 'footerQuick', 'footerCompany'));
    }
}
