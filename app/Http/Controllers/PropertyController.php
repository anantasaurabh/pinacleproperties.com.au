<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\NavItem;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request, $country = null, $suburb = null, $estate = null)
    {
        // Normalise and merge parameters from SEO friendly paths into request filters
        if ($country) {
            $request->merge(['country' => str_replace('-', ' ', urldecode($country))]);
        }
        if ($suburb) {
            $request->merge(['suburb' => str_replace('-', ' ', urldecode($suburb))]);
        }
        if ($estate) {
            $request->merge(['estate' => str_replace('-', ' ', urldecode($estate))]);
        }

        $query = Opportunity::with('agent');

        // Search in title, estate, suburb, and general location
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('estate', 'like', '%' . $search . '%')
                  ->orWhere('suburb', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // State/Country Filter (QLD/VIC)
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Suburb Filter
        if ($request->filled('suburb')) {
            $query->where('suburb', $request->suburb);
        }

        // Estate Filter
        if ($request->filled('estate')) {
            $query->where('estate', $request->estate);
        }

        // Bedrooms Filter
        if ($request->filled('bed')) {
            $query->where('bed', $request->bed);
        }

        // Bathrooms Filter
        if ($request->filled('bath')) {
            $query->where('bath', $request->bath);
        }

        // Garage Filter
        if ($request->filled('garage')) {
            $query->where('garage', $request->garage);
        }

        // Storeys Filter
        if ($request->filled('storeys')) {
            $query->where('storeys', $request->storeys);
        }

        // Advanced Price Ranges
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Advanced Home Area Ranges
        if ($request->filled('min_home_area')) {
            $query->whereRaw("CAST(area AS INTEGER) >= ?", [$request->min_home_area]);
        }
        if ($request->filled('max_home_area')) {
            $query->whereRaw("CAST(area AS INTEGER) <= ?", [$request->max_home_area]);
        }

        // Advanced Block Area Ranges
        if ($request->filled('min_block_area')) {
            $query->whereRaw("CAST(block_area AS INTEGER) >= ?", [$request->min_block_area]);
        }
        if ($request->filled('max_block_area')) {
            $query->whereRaw("CAST(block_area AS INTEGER) <= ?", [$request->max_block_area]);
        }

        $properties = $query->paginate(9);

        // Fetch location hierarchy for frontend dependent dropdowns
        $locationsData = Opportunity::query()
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->whereNotNull('suburb')
            ->where('suburb', '!=', '')
            ->select('country', 'suburb', 'estate')
            ->distinct()
            ->get()
            ->groupBy('country')
            ->map(function ($items) {
                return $items->groupBy('suburb')->map(function ($suburbItems) {
                    return $suburbItems->pluck('estate')->filter()->unique()->values();
                });
            });

        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();

        return view('properties.index', compact('properties', 'headerNav', 'footerQuick', 'footerCompany', 'locationsData'));
    }

    public function show($slug)
    {
        $property = Opportunity::with('agent')->where('slug', $slug)->firstOrFail();
        
        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();

        // Suggested packages
        $suggested = Opportunity::where('id', '!=', $property->id)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        return view('properties.show', compact('property', 'headerNav', 'footerQuick', 'footerCompany', 'suggested'));
    }
}
