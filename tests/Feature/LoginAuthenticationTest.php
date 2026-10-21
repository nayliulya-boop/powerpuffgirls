<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoginAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_sign_in_with_valid_credentials(): void
    {
        $this->seed(LoginSeeder::class);

        $user = User::where('email', 'customer1@example.test')->firstOrFail();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('customer.dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_sign_in_with_valid_credentials(): void
    {
        $this->seed(LoginSeeder::class);

        $user = User::where('email', 'admin@example.test')->firstOrFail();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirectToRoute('customer.dashboard');

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_credentials_are_rejected_without_authenticating(): void
    {
        $this->seed(LoginSeeder::class);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'customer1@example.test',
            'password' => 'incorrect-password',
        ]);

        $response->assertRedirectToRoute('login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_records_marked_deleted_cannot_sign_in(): void
    {
        $this->seed(LoginSeeder::class);
        DB::table('login')
            ->where('email', 'customer1@example.test')
            ->update(['deleted_at' => now()]);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'customer1@example.test',
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_record_cannot_authenticate_a_different_user_email(): void
    {
        $this->seed(LoginSeeder::class);
        DB::table('login')
            ->where('email', 'customer1@example.test')
            ->update(['email' => 'different@example.test']);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'different@example.test',
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_page_submits_credentials_to_login_endpoint(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('method="POST"', false)
            ->assertSee('action="'.route('login.store').'"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false);
    }

    public function test_customer_dashboard_requires_authentication(): void
    {
        $this->get(route('customer.dashboard'))
            ->assertRedirectToRoute('login');
    }

    public function test_authenticated_user_can_view_customer_dashboard(): void
    {
        $this->seed(LoginSeeder::class);
        $user = User::where('email', 'customer1@example.test')->firstOrFail();

        $this->actingAs($user)
            ->get(route('customer.dashboard'))
            ->assertOk()
            ->assertSee('Welcome Customer')
            ->assertSee('My Vacations');
    }

    public function test_missing_credentials_are_rejected_by_validation(): void
    {
        $response = $this->from(route('login'))->post(route('login.store'));

        $response->assertRedirectToRoute('login')
            ->assertSessionHasErrors(['email', 'password']);
        $this->assertGuest();
    }

    public function test_repeated_login_attempts_are_rate_limited(): void
    {
        $this->seed(LoginSeeder::class);

        foreach (range(1, 5) as $attempt) {
            $this->post(route('login.store'), [
                'email' => 'customer1@example.test',
                'password' => 'incorrect-password',
            ]);
        }

        $this->post(route('login.store'), [
            'email' => 'customer1@example.test',
            'password' => 'incorrect-password',
        ])->assertTooManyRequests();

        $this->assertGuest();
    }
}
