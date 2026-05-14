<?php

namespace App\Http\Controllers;

use App\Models\NavItem;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::with(['hero', 'sections.blocks', 'cta'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();

        return view('pages.show', compact('page', 'headerNav', 'footerQuick', 'footerCompany'));
    }

    public function referAFriend()
    {
        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();
        $settings = \App\Models\Setting::pluck('value', 'key');

        return view('pages.refer-a-friend', compact('headerNav', 'footerQuick', 'footerCompany', 'settings'));
    }

    public function submitReferral(Request $request)
    {
        $validated = $request->validate([
            'referrer_name' => 'required|string|max:255',
            'referrer_phone' => 'required|string|max:255',
            'referrer_email' => 'required|email|max:255',
            'referrer_street' => 'required|string|max:255',
            'referrer_suburb' => 'required|string|max:255',
            'referrer_state' => 'required|string|max:255',
            'referrer_postcode' => 'required|string|max:255',
            'friend_name' => 'required|string|max:255',
            'friend_phone' => 'required|string|max:255',
            'friend_email' => 'required|email|max:255',
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to('info@pinacleproperties.com.au')
                ->send(new \App\Mail\ReferralMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your referral has been submitted successfully.'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Referral submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error submitting your referral. Please try again.'
            ], 500);
        }
    }
}
