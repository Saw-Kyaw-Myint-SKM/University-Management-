<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $role = Role::where('name', 'teacher')->first();
        $departments = Department::all();

        if ($departments->isEmpty()) {
            $this->command->warn('No departments found. Run DepartmentSeeder first.');
            return;
        }

        // Fixed demo teacher (already created by UserSeeder)
        $demoUser = User::where('email', 'teacher@university.edu')->first();
        if ($demoUser && !Teacher::where('user_id', $demoUser->id)->exists()) {
            Teacher::create([
                'user_id'         => $demoUser->id,
                'department_id'   => $departments->first()->id,
                'employee_number' => 'EMP-0001',
                'specialization'  => 'Computer Science',
                'phone'           => '+60 12-345 6789',
                'address'         => '123 University Avenue, Kuala Lumpur',
                'status'          => 'active',
            ]);
        }

        // 14 additional fake teachers
        $specializations = [
            'Computer Science', 'Mathematics', 'Physics',
            'Electrical Engineering', 'Mechanical Engineering',
            'Business Administration', 'Accounting', 'Civil Engineering',
        ];

        for ($i = 2; $i <= 15; $i++) {
            $user = User::create([
                'name'               => fake()->name(),
                'email'              => fake()->unique()->safeEmail(),
                'password'           => Hash::make('password123'),
                'role_id'            => $role->id,
                'email_verified_at'  => now(),
            ]);

            Teacher::create([
                'user_id'         => $user->id,
                'department_id'   => $departments->random()->id,
                'employee_number' => 'EMP-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'specialization'  => fake()->randomElement($specializations),
                'phone'           => fake()->numerify('+60 1#-#### ####'),
                'address'         => fake()->address(),
                'status'          => 'active',
            ]);
        }

        $this->command->info('15 teachers seeded.');
    }
}
