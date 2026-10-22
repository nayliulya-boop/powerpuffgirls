<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'title' => 'Santorini Caldera & Oia Villas',
                'location' => 'Greece • Aegean Sea',
                'badge' => 'Best Seller',
                'rating' => 4.98,
                'reviews_count' => 340,
                'duration_days' => 7,
                'description' => 'Iconic whitewashed cliffside suites, infinity pools, private catamaran sunset cruise, and wine tasting.',
                'price' => 1450.00,
                'image_path' => 'images/travel/santorini.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Baa Atoll Overwater Villas',
                'location' => 'Indian Ocean • Atoll',
                'badge' => 'Exclusive',
                'rating' => 5.00,
                'reviews_count' => 480,
                'duration_days' => 6,
                'description' => 'Private infinity pool over crystal lagoon, seaplane transfer, coral reef diving, and gourmet beach dining.',
                'price' => 2190.00,
                'image_path' => 'images/travel/maldives.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Lake Brienz & Jungfrau Alps',
                'location' => 'Switzerland • Interlaken',
                'badge' => 'Alpine Bliss',
                'rating' => 4.96,
                'reviews_count' => 210,
                'duration_days' => 8,
                'description' => 'Turquoise glacial waters, scenic cogwheel trains, wooden mountain chalets, and crisp fresh mountain air.',
                'price' => 1850.00,
                'image_path' => 'images/travel/swiss_alps.jpg',
                'is_featured' => true,
            ],
            [
                'title' => "Côte d'Azur Private Yacht Tour",
                'location' => 'French Riviera • Monaco',
                'badge' => 'VIP Charter',
                'rating' => 5.00,
                'reviews_count' => 125,
                'duration_days' => 5,
                'description' => 'Private captain, onboard champagne chef, secluded cove swimming, and docking along Saint-Tropez.',
                'price' => 3100.00,
                'image_path' => 'images/travel/yacht.jpg',
                'is_featured' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['title' => $destination['title']],
                $destination
            );
        }
    }
}
