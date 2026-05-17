<?php

namespace Database\Seeders;

use App\Models\Admission;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdmissionSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::all();
        $studentRole = Role::where('name', 'student')->first();

        if ($departments->isEmpty()) {
            $this->command->warn('No departments found. Skipping admissions.');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name'               => fake()->name(),
                'email'              => fake()->unique()->safeEmail(),
                'password'           => Hash::make('password123'),
                'role_id'            => $studentRole->id,
                'email_verified_at'  => now(),
            ]);

            Admission::create([
                'user_id'            => $user->id,
                'department_id'      => $departments->random()->id,
                'application_number' => 'APP-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'application_date'   => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'status'             => fake()->randomElement(['pending', 'pending', 'approved', 'rejected']),
                'remarks'            => fake()->optional(0.5)->sentence(),
            ]);
        }

        $this->command->info('10 admissions seeded.');
    }
}
