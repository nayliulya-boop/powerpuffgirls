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
            [
                'title' => 'Pulau Redang Sunset Villa & Marine Sanctuary',
                'location' => 'Malaysia • Pulau Redang, Terengganu',
                'badge' => 'Tropical Island',
                'rating' => 4.97,
                'reviews_count' => 180,
                'duration_days' => 4,
                'description' => 'Beachfront private sunset villa, crystal clear waters, turtle snorkeling tour, and island barbecue dinners.',
                'price' => 1250.00,
                'image_path' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'title' => 'Langkawi Luxury Rainforest Retreat & Private Beach',
                'location' => 'Malaysia • Langkawi, Kedah',
                'badge' => 'Rainforest Luxury',
                'rating' => 4.95,
                'reviews_count' => 140,
                'duration_days' => 3,
                'description' => 'Private plunge pool villa amidst ancient rainforest, Andaman sea views, yacht sunset cruise, and spa wellness.',
                'price' => 1100.00,
                'image_path' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
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
