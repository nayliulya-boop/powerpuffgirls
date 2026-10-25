<?php

namespace Tests\Feature;

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

    public function test_customer_can_create_booking_with_pending_approval_status(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->post(route('customer.vacations.store'), [
            'destination' => 'Santorini, Greece',
            'title' => 'Oia Sunset Cliffside Villa',
            'start_date' => now()->addDays(14)->format('Y-m-d'),
            'end_date' => now()->addDays(20)->format('Y-m-d'),
            'travelers_count' => 2,
            'tier' => 'Platinum Horizon',
            'notes' => 'Special anniversary champagne upon arrival.',
        ]);

        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('vacations', [
            'user_id' => $customer->id,
            'destination' => 'Santorini, Greece',
            'status' => 'pending_approval',
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

    public function test_customer_cannot_pay_for_booking_until_approved(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
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

    public function test_admin_can_preview_and_view_customer_payment_receipt(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'package_code' => 'AV-MLD-999',
            'title' => 'Water Villa Maldives Sanctuary',
            'destination' => 'Maldives',
            'price' => 8800.00,
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);

        $payment = Payment::factory()->create([
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'amount' => 8800.00,
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank2u',
            'transaction_reference' => 'AV-TXN-20261025-MALDIVES',
            'paid_at' => now(),
        ]);

        // 1. Admin booking management shows preview button & modal data
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.bookings.index'));
        $dashboardResponse->assertOk()
            ->assertSee('Preview Resit Pelanggan')
            ->assertSee('AV-TXN-20261025-MALDIVES')
            ->assertSee('8,800.00')
            ->assertSee($customer->name);

        // 2. Admin can directly access and preview the customer's full receipt without 403 Forbidden
        $receiptResponse = $this->actingAs($admin)->get(route('customer.payment.receipt', $vacation));
        $receiptResponse->assertOk()
            ->assertSee('Mode Pentadbir')
            ->assertSee($customer->name)
            ->assertSee('AV-MLD-999')
            ->assertSee('AV-TXN-20261025-MALDIVES')
            ->assertSee('Kembali ke Tempahan Admin');
    }

    public function test_customer_can_process_card_payment(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'price' => 3500.00,
        ]);

        $response = $this->actingAs($customer)->post(route('customer.payment.process', $vacation), [
            'payment_method' => 'card',
            'card_name' => 'Sophia Montgomery',
            'card_number' => '4111 2222 3333 4242',
            'card_expiry' => '12/28',
            'card_cvv' => '888',
        ]);

        $response->assertRedirect(route('customer.payment.receipt', $vacation));

        $this->assertDatabaseHas('payments', [
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'payment_method' => 'card',
            'card_last_four' => '4242',
            'amount' => 3500.00,
            'status' => 'completed',
        ]);

        $this->assertDatabaseHas('vacations', [
            'id' => $vacation->id,
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);
    }

    public function test_customer_can_process_qr_payment(): void
    {
        $customer = $this->createCustomer();

        $vacation = Vacation::factory()->approved()->create([
            'user_id' => $customer->id,
            'price' => 1990.00,
        ]);

        $response = $this->actingAs($customer)->post(route('customer.payment.process', $vacation), [
            'payment_method' => 'qr',
        ]);

        $response->assertRedirect(route('customer.payment.receipt', $vacation));

        $this->assertDatabaseHas('payments', [
            'vacation_id' => $vacation->id,
            'user_id' => $customer->id,
            'payment_method' => 'qr',
            'bank_name' => 'DuitNow QR',
            'amount' => 1990.00,
            'status' => 'completed',
        ]);
    }

    public function test_admin_dashboard_prioritizes_pending_approval_bookings_at_the_top(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        // Older upcoming trip with later start date
        Vacation::factory()->create([
            'user_id' => $customer->id,
            'destination' => 'Bora Bora',
            'status' => 'upcoming',
            'start_date' => now()->addDays(30),
            'created_at' => now()->subDays(5),
        ]);

        // Brand new booking requiring admin availability check
        $pendingBooking = Vacation::factory()->pendingApproval()->create([
            'user_id' => $customer->id,
            'destination' => 'Redang Island Sanctuary',
            'package_code' => 'AV-RED-999',
            'start_date' => now()->addDays(10),
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Perlu Tindakan Segera')
            ->assertSee('Redang Island Sanctuary')
            ->assertSee('AV-RED-999')
            ->assertSee('Pending Check')
            ->assertSee('Sahkan (Approve)');
    }
}
