<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacation>
 */
class VacationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $destinations = [
            [
                'destination' => 'Maldives, South Ari Atoll',
                'title' => 'Overwater Sunset Lagoon Villa & Private Catamaran',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'destination' => 'Amalfi Coast, Italy',
                'title' => 'Cliffside Luxury Suite & Capri Yacht Odyssey',
                'tier' => 'Platinum Horizon',
                'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'destination' => 'Swiss Alps, Zermatt',
                'title' => 'Matterhorn Alpine Chalet & Helicopter Glacier Excursion',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'destination' => 'Santorini, Greece',
                'title' => 'Oia Sunset Infinity Pool Villa & Aegean Wine Tasting',
                'tier' => 'Signature Gold',
                'image_url' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'destination' => 'Kyoto, Japan',
                'title' => 'Traditional Ryokan, Private Onsen & Bamboo Forest Tea Ceremony',
                'tier' => 'Platinum Horizon',
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'destination' => 'Bora Bora, French Polynesia',
                'title' => 'Mount Otemanu Overwater Villa & Shark Snorkel Safari',
                'tier' => 'Diamond Sovereign',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        $choice = fake()->randomElement($destinations);
        $startDate = fake()->dateTimeBetween('+1 week', '+6 months');
        $endDate = (clone $startDate)->modify('+'.fake()->numberBetween(4, 14).' days');

        return [
            'user_id' => User::factory(),
            'package_code' => 'AV-'.strtoupper(fake()->lexify('???')).'-'.fake()->numberBetween(100, 999),
            'destination' => $choice['destination'],
            'title' => $choice['title'],
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'travelers_count' => fake()->numberBetween(1, 4),
            'price' => fake()->randomFloat(2, 2500, 18500),
            'status' => 'upcoming',
            'payment_status' => 'paid',
            'tier' => $choice['tier'],
            'image_url' => $choice['image_url'],
            'notes' => fake()->sentence(10),
        ];
    }

    /**
     * Mark the vacation as pending approval.
     */
    public function pendingApproval(): static
    {
        return $this->state(fn () => [
            'status' => 'pending_approval',
            'payment_status' => 'unpaid',
            'reviewed_by' => null,
            'reviewed_at' => null,
        ]);
    }

    /**
     * Mark the vacation as approved and ready for payment.
     */
    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => 'approved',
            'payment_status' => 'unpaid',
            'admin_notes' => 'Accommodations and private transport confirmed available. Ready for settlement.',
            'reviewed_at' => now(),
        ]);
    }

    /**
     * Mark the vacation as rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
            'payment_status' => 'unpaid',
            'admin_notes' => 'Selected dates are fully booked with no VIP slots available.',
            'reviewed_at' => now(),
        ]);
    }

    /**
     * Mark the vacation as completed.
     */
    public function completed(): static
    {
        return $this->state(fn () => [
            'status' => 'completed',
            'payment_status' => 'paid',
            'start_date' => now()->subMonths(2)->format('Y-m-d'),
            'end_date' => now()->subMonths(2)->addDays(7)->format('Y-m-d'),
        ]);
    }

    /**
     * Mark the vacation as ongoing.
     */
    public function ongoing(): static
    {
        return $this->state(fn () => [
            'status' => 'ongoing',
            'payment_status' => 'paid',
            'start_date' => now()->subDays(2)->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'),
        ]);
    }

    /**
     * Mark the vacation as cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status' => 'cancelled',
            'payment_status' => 'unpaid',
        ]);
    }
}
