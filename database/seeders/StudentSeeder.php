<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $role        = Role::where('name', 'student')->first();
        $departments = Department::all();

        if ($departments->isEmpty()) {
            $this->command->warn('No departments found. Run DepartmentSeeder first.');
            return;
        }

        // Fixed demo student (already created by UserSeeder)
        $demoUser = User::where('email', 'student@university.edu')->first();
        if ($demoUser && !Student::where('user_id', $demoUser->id)->exists()) {
            Student::create([
                'user_id'        => $demoUser->id,
                'department_id'  => $departments->first()->id,
                'student_number' => 'STD-0001',
                'date_of_birth'  => '2000-01-15',
                'phone'          => '+60 12-345 6789',
                'address'        => '456 Student Road, Kuala Lumpur',
                'status'         => 'active',
            ]);
        }

        // 24 additional fake students
        for ($i = 2; $i <= 25; $i++) {
            $user = User::create([
                'name'               => fake()->name(),
                'email'              => fake()->unique()->safeEmail(),
                'password'           => Hash::make('password123'),
                'role_id'            => $role->id,
                'email_verified_at'  => now(),
            ]);

            Student::create([
                'user_id'        => $user->id,
                'department_id'  => $departments->random()->id,
                'student_number' => 'STD-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'date_of_birth'  => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
                'phone'          => fake()->numerify('+60 1#-#### ####'),
                'address'        => fake()->address(),
                'status'         => 'active',
            ]);
        }

        $this->command->info('25 students seeded.');
    }
}
