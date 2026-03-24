<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeHeader($query)
    {
        return $query->where('location', 'header')->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFooterQuickLinks($query)
    {
        return $query->where('location', 'footer_quick_links')->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFooterCompany($query)
    {
        return $query->where('location', 'footer_company')->where('is_active', true)->orderBy('sort_order');
    }
}
