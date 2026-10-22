<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacation_id' => Vacation::factory(),
            'user_id' => User::factory(),
            'amount' => 1250.00,
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank2u',
            'card_last_four' => null,
            'transaction_reference' => 'AV-TXN-'.fake()->unique()->numerify('##########'),
            'status' => 'completed',
            'notes' => 'Direct online payment simulation',
            'paid_at' => now(),
        ];
    }
}
