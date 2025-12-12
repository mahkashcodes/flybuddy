<?php
// app/Models/TravelPackage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'duration_days',
        'price',
        'inclusions',
        'exclusions',
        'max_people',
        'is_active',
        'image_url'
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}