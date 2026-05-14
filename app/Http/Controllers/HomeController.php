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

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'estate' => 'nullable|string|max:255',
            'city' => 'required|string',
            'finance' => 'required|string',
            'source' => 'nullable|string|max:255',
            'timeline' => 'required|string',
            'build_type' => 'required|string',
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to('info@pinacleproperties.com.au')
                ->send(new \App\Mail\InquiryMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry! Our team will contact you shortly.'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Inquiry submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your inquiry. Please try again later.'
            ], 500);
        }
    }
}
