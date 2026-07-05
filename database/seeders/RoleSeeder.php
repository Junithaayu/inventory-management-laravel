<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Role::firstOrCreate([
        'name' => 'Admin',
        'guard_name' => 'web',
    ]);

    Role::firstOrCreate([
        'name' => 'Staff',
        'guard_name' => 'web',
    ]);

    Role::firstOrCreate([
        'name' => 'Manager',
        'guard_name' => 'web',
    ]);
}
}
