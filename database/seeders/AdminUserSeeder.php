<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default admin account for Distro Aseli Aseli.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Distro Aseli Aseli',
                'email' => 'admin@distroaseliaseli.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
