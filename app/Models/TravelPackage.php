<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
       <?php

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
        'duration',
        'price',
        'inclusions',
        'exclusions',
        'max_people',
        'is_active',
        'image_url'
    ];

    // Add relationship to destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
    ];

    // Relationship with Destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}