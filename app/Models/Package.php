<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'destination',
        'duration',
        'price_adult',
        'price_child',
        'featured_image',
        'description',
        'itinerary',
        'included',
        'excluded',
        'terms',
        'is_featured',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price_adult' => 'float',
            'price_child' => 'float',
            'itinerary' => 'array',
            'included' => 'array',
            'excluded' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get bookings for this package.
     *
     * @return HasMany<Booking, $this>
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get reviews for this package.
     *
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
