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
        
        return view('home', compact('opportunities', 'services', 'posts', 'settings'));
    }
}
