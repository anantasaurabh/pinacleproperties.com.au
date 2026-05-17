<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the opportunities/packages for this agent.
     */
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }
}
