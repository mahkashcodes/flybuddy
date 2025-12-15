<?php
// app/Models/Destination.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

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

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'starting_price' => 'decimal:2',
    ];

    // Add this relationship
    public function travelPackages()
    {
        return $this->hasMany(TravelPackage::class);
    }
}