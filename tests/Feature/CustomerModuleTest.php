<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Database\Seeders\TravelPackageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed travel packages
        $this->seed(TravelPackageSeeder::class);
    }

    /**
     * 1. Register & Profile Page Tests
     */
    public function test_customer_can_register_account(): void
    {
        $response = $this->post(route('register.submit'), [
            'name' => 'Faris Danial',
            'email' => 'faris@example.com',
            'phone' => '011-22334455',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect(route('customer.dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'faris@example.com',
            'name' => 'Faris Danial',
        ]);
    }

    public function test_customer_can_update_profile_and_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword'),
        ]);

        $this->actingAs($user);

        // Update Profile
        $profileResponse = $this->post(route('customer.update_profile'), [
            'name' => 'Faris Updated',
            'email' => $user->email,
            'phone' => '019-9988776',
            'address' => 'No 5, Jalan Melati, KL',
        ]);

        $profileResponse->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Faris Updated',
            'phone' => '019-9988776',
        ]);

        // Update Password
        $passwordResponse = $this->post(route('customer.update_password'), [
            'current_password' => 'oldpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $passwordResponse->assertRedirect();
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    /**
     * 2. Pakej Pelancongan (Packages Catalog & Filter)
     */
    public function test_packages_catalog_displays_categories_and_filters(): void
    {
        $response = $this->get(route('packages.index'));

        $response->assertOk()
            ->assertSee('Katalog Pakej Pelancongan')
            ->assertSee('Pakej Pulau')
            ->assertSee('Pakej Umrah/Haji')
            ->assertSee('Honeymoon')
            ->assertSee('Day Trip');

        // Filter by category
        $pulauResponse = $this->get(route('packages.index', ['category' => 'Pakej Pulau']));
        $pulauResponse->assertOk()
            ->assertSee('Pakej Pulau');
    }

    public function test_package_detail_page_displays_itinerary_and_terms(): void
    {
        $package = Package::first();
        $this->assertNotNull($package);

        $response = $this->get(route('packages.show', $package->slug));

        $response->assertOk()
            ->assertSee($package->title)
            ->assertSee('Aturcara Perjalanan (Itinerary)')
            ->assertSee('Pakej Termasuk (Inclusions)')
            ->assertSee('Tidak Termasuk (Exclusions)')
            ->assertSee('Conditions')
            ->assertSee('Kalkulator Harga Tempahan');
    }

    /**
     * 3. Booking Flow
     */
    public function test_customer_can_initiate_and_store_booking(): void
    {
        $package = Package::first();
        $user = User::factory()->create();
        $this->actingAs($user);

        // View booking form
        $createResponse = $this->get(route('booking.create', $package->slug));
        $createResponse->assertOk()
            ->assertSee('Lengkapkan Butiran Tempahan Anda');

        // Submit booking
        $storeResponse = $this->post(route('booking.store', $package->slug), [
            'trip_date' => now()->addDays(14)->format('Y-m-d'),
            'adult_count' => 2,
            'child_count' => 1,
            'contact_name' => 'Ahmad Albab',
            'contact_email' => 'ahmad@example.com',
            'contact_phone' => '013-1122334',
            'special_notes' => 'Makanan halal sahaja',
            'participants' => [
                [
                    'name' => 'Ahmad Albab',
                    'ic_passport' => '900101-14-1111',
                    'phone' => '013-1122334',
                    'type' => 'Dewasa',
                ],
                [
                    'name' => 'Siti Nurhaliza',
                    'ic_passport' => '920202-14-2222',
                    'phone' => '013-9988776',
                    'type' => 'Dewasa',
                ],
            ],
        ]);

        $booking = Booking::where('contact_email', 'ahmad@example.com')->first();
        $this->assertNotNull($booking);
        $storeResponse->assertRedirect(route('booking.payment', $booking->booking_code));
        $this->assertEquals('Pending', $booking->status);
    }

    /**
     * 4. Pembayaran (Payment Gateway & Manual Receipt)
     */
    public function test_payment_gateway_confirms_booking_instantly(): void
    {
        $package = Package::first();
        $booking = Booking::create([
            'booking_code' => 'AZV-TEST-001',
            'package_id' => $package->id,
            'trip_date' => now()->addDays(10)->format('Y-m-d'),
            'adult_count' => 2,
            'child_count' => 0,
            'total_price' => 2000.00,
            'contact_name' => 'Zainal Abidin',
            'contact_email' => 'zainal@example.com',
            'contact_phone' => '017-8877665',
            'status' => 'Pending',
            'payment_status' => 'pending',
            'payment_method' => 'pending',
        ]);

        // Payment Page
        $this->get(route('booking.payment', $booking->booking_code))
            ->assertOk()
            ->assertSee('AZV-TEST-001')
            ->assertSee('ToyyibPay')
            ->assertSee('Billplz')
            ->assertSee('Stripe');

        // Process Gateway Payment
        $paymentResponse = $this->post(route('booking.process_payment', $booking->booking_code), [
            'payment_type' => 'gateway',
            'gateway_provider' => 'toyyibpay',
        ]);

        $paymentResponse->assertRedirect(route('booking.voucher', $booking->booking_code));

        $booking->refresh();
        $this->assertEquals('paid', $booking->payment_status);
        $this->assertEquals('Confirmed', $booking->status);
    }

    public function test_manual_receipt_upload_updates_payment(): void
    {
        Storage::fake('public');

        $package = Package::first();
        $booking = Booking::create([
            'booking_code' => 'AZV-TEST-002',
            'package_id' => $package->id,
            'trip_date' => now()->addDays(10)->format('Y-m-d'),
            'adult_count' => 1,
            'child_count' => 0,
            'total_price' => 1000.00,
            'contact_name' => 'Kamal Adli',
            'contact_email' => 'kamal@example.com',
            'contact_phone' => '019-2233445',
            'status' => 'Pending',
            'payment_status' => 'pending',
            'payment_method' => 'pending',
        ]);

        $file = UploadedFile::fake()->create('slip_bayaran.pdf', 500, 'application/pdf');

        $uploadResponse = $this->post(route('booking.process_payment', $booking->booking_code), [
            'payment_type' => 'manual',
            'receipt_file' => $file,
            'reference_no' => 'MBB-REF-123456',
        ]);

        $uploadResponse->assertRedirect(route('booking.voucher', $booking->booking_code));

        $booking->refresh();
        $this->assertEquals('manual_receipt', $booking->payment_method);
        $this->assertEquals('pending_verification', $booking->payment_status);
        $this->assertNotNull($booking->payment_receipt);
    }

    /**
     * 5. Voucher View & Print
     */
    public function test_booking_voucher_view_renders_properly(): void
    {
        $package = Package::first();
        $booking = Booking::create([
            'booking_code' => 'AZV-TEST-003',
            'package_id' => $package->id,
            'trip_date' => now()->addDays(5)->format('Y-m-d'),
            'adult_count' => 2,
            'child_count' => 0,
            'total_price' => 1500.00,
            'contact_name' => 'Maya Karin',
            'contact_email' => 'maya@example.com',
            'contact_phone' => '012-7766554',
            'status' => 'Confirmed',
            'payment_status' => 'paid',
            'payment_method' => 'toyyibpay',
        ]);

        $response = $this->get(route('booking.voucher', $booking->booking_code));

        $response->assertOk()
            ->assertSee('AZV-TEST-003')
            ->assertSee('Disahkan (CONFIRMED)')
            ->assertSee('Cetak / Muat Turun Baucar (PDF)');
    }

    /**
     * 6. Customer Dashboard & Bookings History
     */
    public function test_customer_dashboard_lists_bookings_by_status(): void
    {
        $user = User::factory()->create();
        $package = Package::first();

        Booking::create([
            'booking_code' => 'AZV-USER-001',
            'user_id' => $user->id,
            'package_id' => $package->id,
            'trip_date' => now()->addDays(20)->format('Y-m-d'),
            'adult_count' => 1,
            'child_count' => 0,
            'total_price' => 899.00,
            'contact_name' => $user->name,
            'contact_email' => $user->email,
            'contact_phone' => '012-3456789',
            'status' => 'Confirmed',
            'payment_status' => 'paid',
            'payment_method' => 'stripe',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('customer.dashboard'));

        $response->assertOk()
            ->assertSee('Sejarah Tempahan Saya (My Bookings)')
            ->assertSee('AZV-USER-001')
            ->assertSee('Disahkan');
    }

    /**
     * 7. Contact Us & Customer Reviews
     */
    public function test_customer_can_send_inquiry_and_submit_review(): void
    {
        // Send Inquiry
        $inquiryResponse = $this->post(route('contact.inquiry'), [
            'name' => 'Ahmad Shahril',
            'email' => 'shahril@example.com',
            'phone' => '018-9988771',
            'subject' => 'Pertanyaan Pakej Perhentian',
            'message' => 'Bolehkah saya bawa kanak-kanak berumur 3 tahun?',
        ]);

        $inquiryResponse->assertRedirect();
        $this->assertDatabaseHas('inquiries', [
            'email' => 'shahril@example.com',
            'subject' => 'Pertanyaan Pakej Perhentian',
        ]);

        // Submit Review
        $package = Package::first();
        $reviewResponse = $this->post(route('contact.review'), [
            'author_name' => 'Puan Salmah',
            'rating' => 5,
            'trip_category' => 'Pakej Pulau',
            'package_id' => $package->id,
            'review_text' => 'Trip yang sangat memuaskan, perkhidmatan bot dan hotel 5 bintang!',
        ]);

        $reviewResponse->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'author_name' => 'Puan Salmah',
            'rating' => 5,
        ]);
    }
}
