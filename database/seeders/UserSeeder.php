<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $studentRole = Role::where('name', 'student')->first();

        User::firstOrCreate(
            ['email' => 'admin@university.edu'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'teacher@university.edu'],
            [
                'name' => 'John Teacher',
                'password' => Hash::make('password123'),
                'role_id' => $teacherRole->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@university.edu'],
            [
                'name' => 'Jane Student',
                'password' => Hash::make('password123'),
                'role_id' => $studentRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
