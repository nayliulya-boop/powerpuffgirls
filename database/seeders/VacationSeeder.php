<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Seeder;

class VacationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        $customer1 = $users->firstWhere('email', 'customer1@example.test') ?? $users->first();

        $sampleVacations = [
            [
                'package_code' => 'AV-MLD-902',
                'destination' => 'Maldives, South Ari Atoll',
                'title' => 'Overwater Sunset Lagoon Villa & Private Catamaran',
                'start_date' => '2026-11-15',
                'end_date' => '2026-11-22',
                'travelers_count' => 2,
                'price' => 8450.00,
                'status' => 'upcoming',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Private seaplane arrival, vintage Dom Perignon welcome, vegetarian breakfast arrangement.',
            ],
            [
                'package_code' => 'AV-AMF-442',
                'destination' => 'Amalfi Coast & Positano, Italy',
                'title' => 'Cliffside Panorama Suite & Private Riva Yacht Charter',
                'start_date' => '2026-12-20',
                'end_date' => '2026-12-28',
                'travelers_count' => 2,
                'price' => 9200.00,
                'status' => 'upcoming',
                'tier' => 'Platinum Horizon',
                'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Helicopter transfer from Naples Airport, sunset dinner reservation at La Sponda.',
            ],
            [
                'package_code' => 'AV-SWI-118',
                'destination' => 'Zermatt & St. Moritz, Switzerland',
                'title' => 'Matterhorn Alpine Chalet & Glacier Helicopter Safari',
                'start_date' => '2026-08-10',
                'end_date' => '2026-08-17',
                'travelers_count' => 4,
                'price' => 12500.00,
                'status' => 'completed',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Ski pass concierge, private fondue chef evening with alpine panoramic terrace.',
            ],
            [
                'package_code' => 'AV-SAN-731',
                'destination' => 'Santorini, Greece',
                'title' => 'Oia Sunset Infinity Pool Villa & Aegean Wine Cruise',
                'start_date' => '2026-05-04',
                'end_date' => '2026-05-11',
                'travelers_count' => 2,
                'price' => 6800.00,
                'status' => 'completed',
                'tier' => 'Signature Gold',
                'image_url' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Private catamaran sunset cruise with chef-prepared Mediterranean dinner.',
            ],
            [
                'package_code' => 'AV-KYO-315',
                'destination' => 'Kyoto & Tokyo, Japan',
                'title' => 'Boutique Ryokan with Private Forest Onsen & Tea Ceremony',
                'start_date' => '2026-03-12',
                'end_date' => '2026-03-20',
                'travelers_count' => 2,
                'price' => 7400.00,
                'status' => 'cancelled',
                'tier' => 'Platinum Horizon',
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Client requested rescheduling due to personal itinerary shift.',
            ],
            [
                'package_code' => 'AV-TOK-550',
                'destination' => 'Hakone & Mount Fuji, Japan',
                'title' => 'Panoramic Onsen Estate & Traditional Kaiseki Dining',
                'start_date' => '2026-11-28',
                'end_date' => '2026-12-05',
                'travelers_count' => 2,
                'price' => 8900.00,
                'status' => 'pending_approval',
                'tier' => 'Platinum Horizon',
                'image_url' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Pending availability verification for private onsen villa.',
            ],
            [
                'package_code' => 'AV-PAR-210',
                'destination' => 'Paris & French Riviera, France',
                'title' => 'Eiffel Penthouse Suite & Private Yacht Day Charter',
                'start_date' => '2026-12-10',
                'end_date' => '2026-12-18',
                'travelers_count' => 2,
                'price' => 10800.00,
                'status' => 'approved',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=800&q=80',
                'notes' => 'Approved booking awaiting client payment settlement.',
            ],
        ];

        foreach ($sampleVacations as $vacationData) {
            Vacation::updateOrCreate(
                [
                    'user_id' => $customer1->id,
                    'package_code' => $vacationData['package_code'],
                ],
                $vacationData
            );
        }

        // Also add a sample vacation for other customers if present
        $otherCustomers = $users->where('id', '!=', $customer1->id);
        foreach ($otherCustomers as $customer) {
            Vacation::updateOrCreate(
                [
                    'user_id' => $customer->id,
                    'package_code' => 'AV-BOR-'.rand(100, 999),
                ],
                [
                    'destination' => 'Bora Bora, French Polynesia',
                    'title' => 'Mount Otemanu Overwater Villa & Shark Snorkel Safari',
                    'start_date' => now()->addMonths(1)->format('Y-m-d'),
                    'end_date' => now()->addMonths(1)->addDays(7)->format('Y-m-d'),
                    'travelers_count' => 2,
                    'price' => 11200.00,
                    'status' => 'upcoming',
                    'tier' => 'Diamond Sovereign',
                    'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
                    'notes' => 'VIP Polynesian floral greeting and private lagoon dinner.',
                ]
            );
        }
    }
}
