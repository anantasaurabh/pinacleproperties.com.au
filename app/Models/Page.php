<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    protected $guarded = [];

    public function hero(): HasOne
    {
        return $this->hasOne(PageHero::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function cta(): HasOne
    {
        return $this->hasOne(PageCta::class);
    }
}
