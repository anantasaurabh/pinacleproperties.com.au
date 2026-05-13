<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\NavItem;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::query();

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $properties = $query->paginate(9);

        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();

        return view('properties.index', compact('properties', 'headerNav', 'footerQuick', 'footerCompany'));
    }

    public function show($slug)
    {
        $property = Opportunity::where('slug', $slug)->firstOrFail();
        
        $headerNav      = NavItem::header()->get();
        $footerQuick    = NavItem::footerQuickLinks()->get();
        $footerCompany  = NavItem::footerCompany()->get();

        // Suggested properties
        $suggested = Opportunity::where('id', '!=', $property->id)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        return view('properties.show', compact('property', 'headerNav', 'footerQuick', 'footerCompany', 'suggested'));
    }
}
