<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Import our Models
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
        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'admin@laracamp.com',
                'email_verified_at' => date('Y-m-d H:i:s',time()),
                'password' => \bcrypt('PasswordAdminLaracamp'),
                'is_admin' => true,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]
        );
    }
}
