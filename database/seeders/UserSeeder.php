<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@inventory.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        $admin->assignRole('Admin');

        $staff = User::firstOrCreate(
            ['email' => 'staff@inventory.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('password123'),
            ]
        );
        
        $staff->assignRole('Staff');
        
        $manager = User::firstOrCreate(
            ['email' => 'manager@inventory.com'],
            [
                'name' => 'Manager',
                'password' => Hash::make('password123'),
            ]
        );
        
        $manager->assignRole('Manager');
    }
}
