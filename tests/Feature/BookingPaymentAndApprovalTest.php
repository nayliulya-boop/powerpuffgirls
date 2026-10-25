<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Payment;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingPaymentAndApprovalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper to create an administrator user.
     */
    private function createAdmin(): User
    {
        $admin = User::factory()->create([
            'name' => 'Agency Administrator',
            'email' => 'admin@azurevoyage.test',
        ]);

        DB::table('login')->insert([
            'user_id' => $admin->id,
            'email' => $admin->email,
            'password' => $admin->password,
            'role' => 'admin',
            'created_at' => now(),
        ]);

        return $admin;
    }

    /**
     * Helper to create a customer user.
     */
    private function createCustomer(): User
    {
        $customer = User::factory()->create([
            'name' => 'Sophia Montgomery',
            'email' => 'sophia@example.test',
        ]);

        DB::table('login')->insert([
            'user_id' => $customer->id,
            'email' => $customer->email,
            'password' => $customer->password,
            'role' => 'customer',
            'created_at' => now(),
        ]);

        return $customer;
    }

    public function test_customer_can_select_destination_and_immediately_proceed_to_payment(): void
    {
        $customer = $this->createCustomer();

        $destination = Destination::create([
            'title' => 'Pulau Redang Sunset Villa & Marine Sanctuary',
            'location' => 'Malaysia • Pulau Redang, Terengganu',
            'badge' => 'Tropical Island',
            'rating' => 4.97,
            'reviews_count' => 180,
            'duration_days' => 4,
            'description' => 'Beachfront private sunset villa and turtle snorkeling tour.',
            'price' => 1250.00,
            'image_path' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
            'is_featured' => true,
        ]);

        $response = $this->actingAs($customer)->post(route('customer.vacations.store'), [
            'destination_id' => $destination->id,
            'start_date' => now()->addDays(7)->format('Y-m-d'),
            'end_date' => now()->addDays(11)->format('Y-m-d'),
            'travelers_count' => 2,
            'tier' => 'Platinum Horizon',
            'notes' => 'Airport boat pickup requested.',
        ]);

        $vacation = Vacation::where('user_id', $customer->id)->latest()->first();

        $this->assertNotNull($vacation);
        $response->assertRedirect(route('customer.payment.show', $vacation));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'user_id' => $customer->id,
            'destination' => 'Malaysia • Pulau Redang, Terengganu',
            'title' => 'Pulau Redang Sunset Villa & Marine Sanctuary',
            'status' => 'approved',
            'payment_status' => 'unpaid',
            'tier' => 'Platinum Horizon',
        ]);
    }

    public function test_admin_can_view_all_booking_requests(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'destination' => 'Maldives Lagoon Retreat',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.bookings.index'));

        $response->assertOk()
            ->assertSee('Booking Availability Management')
            ->assertSee('Maldives Lagoon Retreat')
            ->assertSee($vacation->package_code)
            ->assertSee($customer->name);
    }

    public function test_non_admin_cannot_access_admin_bookings(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->get(route('admin.bookings.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_approve_booking_availability(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'package_code' => 'AV-MLD-777',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.bookings.approve', $vacation), [
            'admin_notes' => 'Accommodations and private seaplane transfers confirmed available.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'approved',
            'payment_status' => 'unpaid',
            'admin_notes' => 'Accommodations and private seaplane transfers confirmed available.',
            'reviewed_by' => $admin->id,
        ]);
    }

    public function test_admin_can_reject_booking_availability(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'package_code' => 'AV-SAN-888',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.bookings.reject', $vacation), [
            'admin_notes' => 'Villa is booked for a private event on the requested dates.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'rejected',
            'payment_status' => 'unpaid',
            'admin_notes' => 'Villa is booked for a private event on the requested dates.',
            'reviewed_by' => $admin->id,
        ]);
    }

    public function test_customer_cannot_pay_for_rejected_or_cancelled_booking(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->create([
            'user_id' => $customer->id,
            'status' => 'rejected',
            'payment_status' => 'unpaid',
        ]);

        $response = $this->actingAs($customer)->get(route('customer.payment.show', $vacation));

        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('info');
    }

    public function test_customer_can_view_payment_screen_once_approved(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'destination' => 'Bora Bora Overwater Bungalow',
            'price' => 7500.00,
        ]);

        $response = $this->actingAs($customer)->get(route('customer.payment.show', $vacation));

        $response->assertOk()
            ->assertSee('Select Payment Method')
            ->assertSee('Bora Bora Overwater Bungalow')
            ->assertSee('7,500.00')
            ->assertSee('Maybank (Malayan Banking Berhad)');
    }

    public function test_customer_can_successfully_process_fpx_payment(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'price' => 5400.00,
        ]);

        $response = $this->actingAs($customer)->post(route('customer.payment.process', $vacation), [
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank2u',
        ]);

        $response->assertRedirect(route('customer.payment.receipt', $vacation));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('payments', [
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'amount' => 5400.00,
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank2u',
            'status' => 'completed',
        ]);

        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);
    }

    public function test_customer_can_view_official_e_voucher_and_receipt(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'destination' => 'Swiss Alps Chalet',
            'price' => 6200.00,
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);

        Payment::factory()->create([
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'amount' => 6200.00,
            'payment_method' => 'card',
            'transaction_reference' => 'AV-TXN-20261022-998877',
        ]);

        $response = $this->actingAs($customer)->get(route('customer.payment.receipt', $vacation));

        $response->assertOk()
            ->assertSee('CONFIRMED', false)
            ->assertSee('SETTLED', false)
            ->assertSee('AV-TXN-20261022-998877')
            ->assertSee('Swiss Alps Chalet')
            ->assertSee($customer->name)
            ->assertSee('6,200.00');
    }

    public function test_unauthorized_user_cannot_view_or_pay_other_user_booking(): void
    {
        $customer1 = $this->createCustomer();

        $customer2 = User::factory()->create([
            'name' => 'Intruder User',
            'email' => 'intruder@example.test',
        ]);

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer1->id,
        ]);

        $response = $this->actingAs($customer2)->get(route('customer.payment.show', $vacation));
        $response->assertForbidden();

        $processResponse = $this->actingAs($customer2)->post(route('customer.payment.process', $vacation), [
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank2u',
        ]);
        $processResponse->assertForbidden();
    }

    public function test_admin_can_approve_pending_booking_from_dashboard(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'destination' => 'Bora Bora Overwater Bungalow',
            'package_code' => 'AV-BOR-555',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.vacations.status', $vacation), [
            'status' => 'approved',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'approved',
            'reviewed_by' => $admin->id,
        ]);
    }

    public function test_admin_can_cancel_pending_booking_from_dashboard(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'destination' => 'Cancun Resort Suite',
            'package_code' => 'AV-CAN-888',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.vacations.status', $vacation), [
            'status' => 'cancelled',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_admin_can_filter_bookings_by_status_on_dashboard(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'destination' => 'Pending Tokyo Journey',
            'package_code' => 'AV-TOK-111',
        ]);

        Vacation::factory()->completed()->create([
            'user_id' => $customer->id,
            'destination' => 'Completed Rome Journey',
            'package_code' => 'AV-ROM-222',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'pending']));
        $response->assertOk()
            ->assertSee('Pending Tokyo Journey')
            ->assertDontSee('Completed Rome Journey');

        $completedResponse = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'completed']));
        $completedResponse->assertOk()
            ->assertSee('Completed Rome Journey')
            ->assertDontSee('Pending Tokyo Journey');
    }
}
