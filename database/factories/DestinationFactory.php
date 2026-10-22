<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->city().' Luxury Escape',
            'location' => fake()->country().' • '.fake()->city(),
            'badge' => fake()->randomElement(['Best Seller', 'Exclusive', 'Alpine Bliss', 'VIP Charter', null]),
            'rating' => fake()->randomFloat(2, 4.85, 5.00),
            'reviews_count' => fake()->numberBetween(80, 500),
            'duration_days' => fake()->numberBetween(5, 14),
            'description' => fake()->sentence(12),
            'price' => fake()->randomFloat(2, 1200, 4500),
            'image_path' => fake()->randomElement([
                'images/travel/santorini.jpg',
                'images/travel/maldives.jpg',
                'images/travel/swiss_alps.jpg',
                'images/travel/yacht.jpg',
            ]),
            'is_featured' => true,
        ];
    }
}
