<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );

        $userRole = Role::firstOrCreate(
            ['name' => 'user'],
        );

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('testadmin123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('testuser123'),
            'role_id' => $userRole->id,
        ]);
    }
}
