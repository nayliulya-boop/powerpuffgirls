<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('signup'));

        $response->assertOk()
            ->assertSee('Create Your Account')
            ->assertSee('action="'.route('signup.store').'"', false)
            ->assertSee('name="name"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false)
            ->assertSee('name="password_confirmation"', false);
    }

    public function test_new_customer_can_register_and_connects_to_database(): void
    {
        $response = $this->post(route('signup.store'), [
            'name' => 'Sophia Montgomery',
            'email' => 'sophia.montgomery@example.test',
            'password' => 'luxuryVoyage2026!',
            'password_confirmation' => 'luxuryVoyage2026!',
        ]);

        $response->assertRedirectToRoute('customer.dashboard')
            ->assertSessionHas('success');

        $this->assertAuthenticated();

        $user = User::where('email', 'sophia.montgomery@example.test')->first();
        $this->assertNotNull($user);
        $this->assertSame('Sophia Montgomery', $user->name);
        $this->assertTrue(Hash::check('luxuryVoyage2026!', $user->password));

        $loginRecord = DB::table('login')->where('user_id', $user->id)->first();
        $this->assertNotNull($loginRecord);
        $this->assertSame('sophia.montgomery@example.test', $loginRecord->email);
        $this->assertSame('customer', $loginRecord->role);
        $this->assertTrue(Hash::check('luxuryVoyage2026!', $loginRecord->password));
    }

    public function test_registered_customer_can_sign_in_via_login_portal(): void
    {
        $this->post(route('signup.store'), [
            'name' => 'Alexander Vance',
            'email' => 'alex.vance@example.test',
            'password' => 'secretPassword123!',
            'password_confirmation' => 'secretPassword123!',
        ]);

        // Sign out
        $this->post(route('logout'));
        $this->assertGuest();

        // Sign back in through standard login
        $response = $this->post(route('login.store'), [
            'email' => 'alex.vance@example.test',
            'password' => 'secretPassword123!',
        ]);

        $response->assertRedirectToRoute('customer.dashboard');
        $this->assertAuthenticated();
    }

    public function test_registration_validation_enforces_required_fields_and_password_rules(): void
    {
        $response = $this->from(route('signup'))->post(route('signup.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
        ]);

        $response->assertRedirectToRoute('signup')
            ->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertGuest();
    }

    public function test_registration_rejects_duplicate_email(): void
    {
        $this->seed(LoginSeeder::class);

        $response = $this->from(route('signup'))->post(route('signup.store'), [
            'name' => 'Duplicate User',
            'email' => 'customer1@example.test',
            'password' => 'validPassword123!',
            'password_confirmation' => 'validPassword123!',
        ]);

        $response->assertRedirectToRoute('signup')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_visiting_signup_is_redirected(): void
    {
        $this->seed(LoginSeeder::class);
        $user = User::where('email', 'customer1@example.test')->firstOrFail();

        $this->actingAs($user)
            ->get(route('signup'))
            ->assertRedirectToRoute('profile');
    }
}
