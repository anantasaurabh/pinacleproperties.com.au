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
}
