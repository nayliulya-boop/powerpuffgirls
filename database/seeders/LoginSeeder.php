<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LogicException;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new LogicException('Login demo data can only be seeded in local or testing environments.');
        }

        $sampleUsers = [
            ['name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin'],
            ['name' => 'Customer One', 'email' => 'customer1@example.test', 'role' => 'customer'],
            ['name' => 'Customer Two', 'email' => 'customer2@example.test', 'role' => 'customer'],
            ['name' => 'Customer Three', 'email' => 'customer3@example.test', 'role' => 'customer'],
            ['name' => 'Customer Four', 'email' => 'customer4@example.test', 'role' => 'customer'],
        ];

        foreach ($sampleUsers as $sampleUser) {
            $user = User::firstOrCreate(
                ['email' => $sampleUser['email']],
                ['name' => $sampleUser['name'], 'password' => 'password'],
            );

            DB::table('login')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'email' => $sampleUser['email'],
                    'password' => $user->password,
                    'role' => $sampleUser['role'],
                    'deleted_at' => null,
                ],
            );
        }
    }
}
