<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Create the default super-admin account.
     * Change the password immediately after first login!
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@easygo.pk'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('Admin@123'),
                'role'     => 'super_admin',
                'is_active' => true,
            ]
        );
    }
}
