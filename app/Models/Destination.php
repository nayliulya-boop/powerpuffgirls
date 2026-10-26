<?php

namespace App\Models;

use Database\Factories\DestinationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'location',
    'badge',
    'rating',
    'reviews_count',
    'duration_days',
    'capacity',
    'amenities',
    'start_date',
    'end_date',
    'description',
    'price',
    'image_path',
    'is_featured',
    'is_active',
])]
class Destination extends Model
{
    /** @use HasFactory<DestinationFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'decimal:2',
            'reviews_count' => 'integer',
            'duration_days' => 'integer',
            'capacity' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
