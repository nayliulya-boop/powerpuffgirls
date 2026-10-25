<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerVacationTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_vacation_table_displays_user_vacations(): void
    {
        $user = User::factory()->create(['name' => 'Alexander Vance']);
        $vacation = Vacation::factory()->create([
            'user_id' => $user->id,
            'package_code' => 'AV-MLD-902',
            'destination' => 'Maldives, South Ari Atoll',
            'title' => 'Overwater Sunset Lagoon Villa & Private Catamaran',
            'price' => 8450.00,
            'status' => 'upcoming',
        ]);

        $this->actingAs($user)
            ->get(route('customer.dashboard'))
            ->assertOk()
            ->assertSee('My Vacations')
            ->assertSee('AV-MLD-902')
            ->assertSee('Maldives, South Ari Atoll')
            ->assertSee('RM 8,450.00')
            ->assertSee('Upcoming');
    }

    public function test_customer_can_filter_vacations_by_status(): void
    {
        $user = User::factory()->create();

        Vacation::factory()->create([
            'user_id' => $user->id,
            'destination' => 'Maldives Upcoming',
            'status' => 'upcoming',
        ]);

        Vacation::factory()->completed()->create([
            'user_id' => $user->id,
            'destination' => 'Swiss Alps Past',
        ]);

        $upcomingResponse = $this->actingAs($user)
            ->get(route('customer.dashboard', ['status' => 'upcoming']))
            ->assertOk();

        $upcomingResponse->assertSee('Maldives Upcoming')
            ->assertDontSee('Swiss Alps Past');

        $completedResponse = $this->actingAs($user)
            ->get(route('customer.dashboard', ['status' => 'completed']))
            ->assertOk();

        $completedResponse->assertSee('Swiss Alps Past')
            ->assertDontSee('Maldives Upcoming');
    }

    public function test_customer_can_search_vacations_by_destination_or_code(): void
    {
        $user = User::factory()->create();

        Vacation::factory()->create([
            'user_id' => $user->id,
            'destination' => 'Santorini Caldera',
            'package_code' => 'AV-SAN-731',
        ]);

        Vacation::factory()->create([
            'user_id' => $user->id,
            'destination' => 'Kyoto Bamboo Forest',
            'package_code' => 'AV-KYO-101',
        ]);

        $this->actingAs($user)
            ->get(route('customer.dashboard', ['search' => 'Santorini']))
            ->assertOk()
            ->assertSee('Santorini Caldera')
            ->assertDontSee('Kyoto Bamboo Forest');
    }

    public function test_customer_can_book_new_vacation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('customer.vacations.store'), [
                'destination' => 'Bora Bora, French Polynesia',
                'title' => 'Mount Otemanu Overwater Villa & Safari',
                'start_date' => now()->addDays(10)->format('Y-m-d'),
                'end_date' => now()->addDays(17)->format('Y-m-d'),
                'travelers_count' => 2,
                'tier' => 'Diamond Sovereign',
                'notes' => 'Helicopter arrival and vintage champagne.',
            ]);

        $response->assertRedirectToRoute('customer.dashboard')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('vacations', [
            'user_id' => $user->id,
            'destination' => 'Bora Bora, French Polynesia',
            'title' => 'Mount Otemanu Overwater Villa & Safari',
            'tier' => 'Diamond Sovereign',
            'status' => 'pending_approval',
        ]);
    }

    public function test_booking_validation_requires_mandatory_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('customer.vacations.store'), []);

        $response->assertSessionHasErrors(['destination', 'title', 'start_date', 'end_date', 'travelers_count', 'tier']);
    }

    public function test_customer_can_cancel_upcoming_vacation(): void
    {
        $user = User::factory()->create();
        $vacation = Vacation::factory()->create([
            'user_id' => $user->id,
            'status' => 'upcoming',
        ]);

        $response = $this->actingAs($user)
            ->post(route('customer.vacations.cancel', $vacation));

        $response->assertRedirectToRoute('customer.dashboard')
            ->assertSessionHas('info');

        $this->assertEquals('cancelled', $vacation->fresh()->status);
    }

    public function test_customer_cannot_cancel_another_customers_vacation(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $vacation = Vacation::factory()->create([
            'user_id' => $owner->id,
            'status' => 'upcoming',
        ]);

        $this->actingAs($otherUser)
            ->post(route('customer.vacations.cancel', $vacation))
            ->assertForbidden();

        $this->assertEquals('upcoming', $vacation->fresh()->status);
    }

    public function test_authenticated_customer_can_sign_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('logout'));

        $response->assertRedirectToRoute('login')
            ->assertSessionHas('status');

        $this->assertGuest();
    }

    public function test_authenticated_customer_can_view_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Lady Genevieve',
            'email' => 'genevieve@example.test',
        ]);

        $this->actingAs($user)
            ->get(route('customer.profile'))
            ->assertOk()
            ->assertSee('Lady Genevieve')
            ->assertSee('genevieve@example.test')
            ->assertSee(route('customer.dashboard'))
            ->assertSee(route('customer.profile'))
            ->assertSee(route('customer.history'));
    }

    public function test_authenticated_customer_can_view_history(): void
    {
        $user = User::factory()->create(['name' => 'Lord Harrington']);

        Vacation::factory()->completed()->create([
            'user_id' => $user->id,
            'destination' => 'Amalfi Coast Villa',
        ]);

        Vacation::factory()->cancelled()->create([
            'user_id' => $user->id,
            'destination' => 'Cancelled Tokyo Trip',
        ]);

        $this->actingAs($user)
            ->get(route('customer.history'))
            ->assertOk()
            ->assertSee('Amalfi Coast Villa')
            ->assertSee('Completed Journey')
            ->assertDontSee('Cancelled Tokyo Trip')
            ->assertSee(route('customer.dashboard'))
            ->assertSee(route('customer.profile'))
            ->assertSee(route('customer.history'));
    }

    public function test_unauthenticated_user_cannot_access_profile_or_history(): void
    {
        $this->get(route('customer.profile'))
            ->assertRedirectToRoute('login');

        $this->get(route('customer.history'))
            ->assertRedirectToRoute('login');
    }
}
