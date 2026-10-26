<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Payment;
use App\Models\User;
use App\Models\Vacation;
use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementSuiteTest extends TestCase
{
    use RefreshDatabase;

    private function getAdminUser(): User
    {
        $this->seed(LoginSeeder::class);

        return User::where('email', 'admin@example.test')->firstOrFail();
    }

    private function getCustomerUser(): User
    {
        return User::where('email', 'customer1@example.test')->firstOrFail();
    }

    public function test_admin_can_publish_new_package_with_capacity_and_amenities(): void
    {
        $admin = $this->getAdminUser();

        $response = $this->actingAs($admin)->post(route('admin.destinations.store'), [
            'title' => 'Swiss Alps Panoramic Chalet',
            'location' => 'Zermatt, Switzerland',
            'duration_days' => 6,
            'capacity' => 4,
            'amenities' => 'Private Ski Lift, Heated Jacuzzi, Butler',
            'start_date' => '2026-12-01',
            'end_date' => '2026-12-07',
            'price' => 15000.00,
            'description' => 'Luxury mountain escape with Matterhorn views.',
            'is_active' => '1',
            'is_featured' => '1',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseHas('destinations', [
            'title' => 'Swiss Alps Panoramic Chalet',
            'capacity' => 4,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_existing_package_information(): void
    {
        $admin = $this->getAdminUser();
        $destination = Destination::factory()->create([
            'title' => 'Old Title',
            'price' => 5000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.destinations.update', $destination), [
            'title' => 'Updated Luxury Haven',
            'location' => 'Maldives',
            'duration_days' => 5,
            'capacity' => 2,
            'price' => 9500.00,
            'description' => 'Updated sanctuary description.',
            'is_active' => '1',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'title' => 'Updated Luxury Haven',
            'price' => 9500.00,
        ]);
    }

    public function test_admin_can_toggle_package_active_status(): void
    {
        $admin = $this->getAdminUser();
        $destination = Destination::factory()->create([
            'title' => 'Santorini Sunset Villa',
            'is_active' => true,
        ]);

        // Toggle from active to inactive
        $this->actingAs($admin)->post(route('admin.destinations.toggle', $destination));
        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'is_active' => false,
        ]);

        // Toggle from inactive to active
        $this->actingAs($admin)->post(route('admin.destinations.toggle', $destination));
        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_process_payment_refund(): void
    {
        $admin = $this->getAdminUser();
        $customer = $this->getCustomerUser();

        $vacation = Vacation::factory()->create([
            'user_id' => $customer->id,
            'price' => 8500.00,
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);

        $payment = Payment::factory()->create([
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'amount' => 8500.00,
            'status' => 'completed',
            'transaction_reference' => 'AV-TXN-REFUND-001',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.payments.refund', $payment));

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => 'refunded',
        ]);
        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'cancelled',
            'payment_status' => 'refunded',
        ]);
    }

    public function test_admin_dashboard_displays_all_five_specified_modules(): void
    {
        $admin = $this->getAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Welcome Admin')
            ->assertSee('Manage Packages')
            ->assertSee('Manage Bookings')
            ->assertSee('Manage Payments')
            ->assertSee('Customers & Reports', false)
            ->assertSee('Total Bookings')
            ->assertSee('Successful Payments')
            ->assertSee('Upcoming Trips')
            ->assertSee('Completed Trips')
            ->assertSee('Cancelled Bookings')
            ->assertSee('All Client Bookings');
    }
}
