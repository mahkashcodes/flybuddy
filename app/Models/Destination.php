<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

  // Allow mass assignment for these columns
    protected $fillable = [
          'name',
        'description',
        'country',
        'continent',
        'best_time_to_visit',
        'starting_price',
        'is_featured',
        'is_active',
        'featured_image'
    ];

    // Casts for convenience
    protected $casts = [
        'starting_price' => 'decimal:2',
    ];

    /**
     * Get the travel packages for this destination.
     */
    public function travelPackages(): HasMany
    {
        return $this->hasMany(TravelPackage::class);
    }

    // Alias for easier access
    public function packages(): HasMany
    {
        return $this->travelPackages();
    }
}
