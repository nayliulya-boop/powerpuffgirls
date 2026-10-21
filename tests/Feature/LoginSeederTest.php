<?php

namespace Tests\Feature;

use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LogicException;
use Tests\TestCase;

class LoginSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeds_demo_logins_with_admin_and_customer_roles_and_hashed_passwords(): void
    {
        $this->seed(LoginSeeder::class);

        $this->assertDatabaseCount('login', 5);
        $this->assertDatabaseHas('login', [
            'email' => 'admin@example.test',
            'role' => 'admin',
        ]);
        $this->assertDatabaseHas('login', [
            'email' => 'customer1@example.test',
            'role' => 'customer',
        ]);
        $this->assertDatabaseHas('login', [
            'email' => 'customer2@example.test',
            'role' => 'customer',
        ]);
        $this->assertDatabaseHas('login', [
            'email' => 'customer3@example.test',
            'role' => 'customer',
        ]);
        $this->assertDatabaseHas('login', [
            'email' => 'customer4@example.test',
            'role' => 'customer',
        ]);

        $adminLogin = DB::table('login')->where('email', 'admin@example.test')->first();

        $this->assertTrue(Hash::check('password', $adminLogin->password));
    }

    public function test_refuses_to_seed_demo_logins_outside_local_and_testing_environments(): void
    {
        app()->instance('env', 'production');

        $this->expectException(LogicException::class);

        $this->seed(LoginSeeder::class);
    }
}
