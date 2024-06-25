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
        $adminUser = User::where('role', 'admin')->first();
        if (!$adminUser) {
            // Create the admin user
            User::create([
                'name' => 'Admin',
                'role' => 'admin',
                'unique_code' => 'one',
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
