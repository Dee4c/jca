<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin user already exists
        $adminUser = User::where('username', 'admin')->first();
        if (!$adminUser) {
            // Create the admin user
            User::create([
                'name' => 'Admin',
                'username' => 'admin',
                'password' => 'admin1',
                'role' => 'admin',
            ]);
        }
    }
}
