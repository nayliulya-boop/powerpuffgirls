<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CustomerVoucherPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_customer_can_stream_pdf_voucher(): void
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $vacation = Vacation::factory()->create([
            'user_id' => $user->id,
            'package_code' => 'AV-MAL-997',
            'destination' => 'Pulau Redang, Malaysia',
            'title' => 'Redang Luxury Sunset Villa',
            'status' => 'upcoming',
            'payment_status' => 'paid',
            'price' => 12500.00,
        ]);

        Payment::factory()->create([
            'vacation_id' => $vacation->id,
            'user_id' => $user->id,
            'amount' => 12500.00,
            'payment_method' => 'fpx',
            'bank_name' => 'Maybank',
            'transaction_reference' => 'AV-TXN-20261027-TEST',
            'status' => 'completed',
        ]);

        $response = $this->actingAs($user)->get(route('customer.payment.receipt.pdf', $vacation));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringContainsString('inline; filename="AzureVoyage-Voucher-AV-MAL-997.pdf"', $response->headers->get('Content-Disposition') ?? '');
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }

    public function test_authenticated_customer_can_download_pdf_voucher(): void
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $vacation = Vacation::factory()->create([
            'user_id' => $user->id,
            'package_code' => 'AV-MAL-997',
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);

        $response = $this->actingAs($user)->get(route('customer.payment.receipt.pdf', ['vacation' => $vacation, 'download' => 1]));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringContainsString('attachment; filename="AzureVoyage-Voucher-AV-MAL-997.pdf"', $response->headers->get('Content-Disposition') ?? '');
    }

    public function test_authenticated_customer_can_print_pdf_voucher(): void
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $vacation = Vacation::factory()->create([
            'user_id' => $user->id,
            'package_code' => 'AV-MAL-997',
            'status' => 'upcoming',
            'payment_status' => 'paid',
        ]);

        $response = $this->actingAs($user)->get(route('customer.payment.receipt.pdf', ['vacation' => $vacation, 'print' => 1]));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringContainsString('inline; filename="AzureVoyage-Voucher-AV-MAL-997.pdf"', $response->headers->get('Content-Disposition') ?? '');
    }

    public function test_unauthenticated_user_cannot_access_pdf_voucher(): void
    {
        $user = User::factory()->create();
        $vacation = Vacation::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('customer.payment.receipt.pdf', $vacation));

        $response->assertRedirectToRoute('login');
    }

    public function test_customer_cannot_access_another_customer_pdf_voucher(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $vacation = Vacation::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($otherUser)->get(route('customer.payment.receipt.pdf', $vacation));

        $response->assertForbidden();
    }

    public function test_admin_can_access_any_customer_pdf_voucher(): void
    {
        $customer = User::factory()->create();
        $vacation = Vacation::factory()->create([
            'user_id' => $customer->id,
            'package_code' => 'AV-ADMIN-001',
        ]);

        $admin = User::factory()->create();
        DB::table('login')->insert([
            'user_id' => $admin->id,
            'email' => $admin->email,
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('customer.payment.receipt.pdf', $vacation));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
