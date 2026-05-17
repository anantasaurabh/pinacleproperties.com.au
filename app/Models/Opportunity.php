<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opportunity extends Model
{
    /** @use HasFactory<\Database\Factories\OpportunityFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Get the agent assigned to this package.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
