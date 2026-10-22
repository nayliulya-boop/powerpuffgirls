<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_users_are_redirected_to_login(): void
    {
        $this->get(route('profile'))->assertRedirectToRoute('login');
        $this->get(route('customer.profile'))->assertRedirectToRoute('login');
        $this->get(route('admin.profile'))->assertRedirectToRoute('login');
    }

    public function test_customer_accessing_profile_is_redirected_to_customer_profile(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $this->actingAs($customer)
            ->get(route('profile'))
            ->assertRedirectToRoute('customer.profile');
    }

    public function test_admin_accessing_profile_is_redirected_to_admin_profile(): void
    {
        $this->seed(LoginSeeder::class);
        $admin = User::where('email', 'admin@example.test')->firstOrFail();

        $this->actingAs($admin)
            ->get(route('profile'))
            ->assertRedirectToRoute('admin.profile');
    }

    public function test_customer_can_view_customer_profile(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $this->actingAs($customer)
            ->get(route('customer.profile'))
            ->assertOk()
            ->assertSee('Customer Profile')
            ->assertSee($customer->name)
            ->assertSee($customer->email);
    }

    public function test_customer_can_update_profile_and_sync_to_database(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $response = $this->actingAs($customer)->put(route('customer.profile.update'), [
            'name' => 'Updated Customer Name',
            'email' => 'updated.customer@example.test',
            'phone' => '+1 (555) 999-1234',
            'address' => '90210 Wilshire Blvd, Beverly Hills, CA',
            'bio' => 'Prefers overwater bungalows and private yacht charters.',
        ]);

        $response->assertRedirectToRoute('customer.profile')
            ->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'Updated Customer Name',
            'email' => 'updated.customer@example.test',
            'phone' => '+1 (555) 999-1234',
            'address' => '90210 Wilshire Blvd, Beverly Hills, CA',
            'bio' => 'Prefers overwater bungalows and private yacht charters.',
        ]);

        $this->assertDatabaseHas('login', [
            'user_id' => $customer->id,
            'email' => 'updated.customer@example.test',
            'role' => 'customer',
        ]);
    }

    public function test_customer_can_update_password_and_login_with_new_password(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $response = $this->actingAs($customer)->put(route('customer.profile.update'), [
            'name' => $customer->name,
            'email' => $customer->email,
            'current_password' => 'password',
            'new_password' => 'newSecretPassword123!',
            'new_password_confirmation' => 'newSecretPassword123!',
        ]);

        $response->assertRedirectToRoute('customer.profile');

        $updatedCustomer = $customer->fresh();
        $this->assertTrue(Hash::check('newSecretPassword123!', $updatedCustomer->password));

        $loginRecord = DB::table('login')->where('user_id', $customer->id)->first();
        $this->assertTrue(Hash::check('newSecretPassword123!', $loginRecord->password));

        // Attempt login with new password
        $this->post(route('logout'));

        $this->post(route('login.store'), [
            'email' => $customer->email,
            'password' => 'newSecretPassword123!',
        ])->assertRedirectToRoute('customer.dashboard');

        $this->assertAuthenticatedAs($updatedCustomer);
    }

    public function test_customer_cannot_access_or_update_admin_profile(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $this->actingAs($customer)
            ->get(route('admin.profile'))
            ->assertForbidden();

        $this->actingAs($customer)
            ->put(route('admin.profile.update'), [
                'name' => 'Hacked Admin',
                'email' => 'hacked@example.test',
            ])
            ->assertForbidden();
    }

    public function test_admin_can_view_admin_profile(): void
    {
        $this->seed(LoginSeeder::class);
        $admin = User::where('email', 'admin@example.test')->firstOrFail();

        $this->actingAs($admin)
            ->get(route('admin.profile'))
            ->assertOk()
            ->assertSee('Administrator Portal')
            ->assertSee('System Administrator')
            ->assertSee($admin->name)
            ->assertSee($admin->email);
    }

    public function test_admin_can_update_profile_and_sync_to_database(): void
    {
        $this->seed(LoginSeeder::class);
        $admin = User::where('email', 'admin@example.test')->firstOrFail();

        $response = $this->actingAs($admin)->put(route('admin.profile.update'), [
            'name' => 'Executive Director John',
            'email' => 'director.john@example.test',
            'phone' => '+1 (800) 429-8732 ext. 100',
            'department' => 'Global VIP Operations',
            'bio' => 'Oversees high-net-worth traveler arrangements and partner luxury resorts.',
        ]);

        $response->assertRedirectToRoute('admin.profile')
            ->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'name' => 'Executive Director John',
            'email' => 'director.john@example.test',
            'phone' => '+1 (800) 429-8732 ext. 100',
            'department' => 'Global VIP Operations',
            'bio' => 'Oversees high-net-worth traveler arrangements and partner luxury resorts.',
        ]);

        $this->assertDatabaseHas('login', [
            'user_id' => $admin->id,
            'email' => 'director.john@example.test',
            'role' => 'admin',
        ]);
    }

    public function test_profile_update_rejects_duplicate_email(): void
    {
        $this->seed(LoginSeeder::class);
        $customer1 = User::where('email', 'customer1@example.test')->firstOrFail();
        $customer2 = User::where('email', 'customer2@example.test')->firstOrFail();

        $response = $this->actingAs($customer1)->put(route('customer.profile.update'), [
            'name' => $customer1->name,
            'email' => $customer2->email, // duplicate email belonging to customer2
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_profile_password_update_rejects_invalid_current_password(): void
    {
        $this->seed(LoginSeeder::class);
        $customer = User::where('email', 'customer1@example.test')->firstOrFail();

        $response = $this->actingAs($customer)->put(route('customer.profile.update'), [
            'name' => $customer->name,
            'email' => $customer->email,
            'current_password' => 'wrong-password',
            'new_password' => 'newPassword123!',
            'new_password_confirmation' => 'newPassword123!',
        ]);

        $response->assertSessionHasErrors('current_password');
    }
}
