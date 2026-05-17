<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdmissionFactory extends Factory
{
    public function definition()
    {
        static $counter = 1;

        return [
            'user_id'            => User::factory()->state(['role_id' => 3]),
            'department_id'      => Department::factory(),
            'application_number' => 'APP-' . str_pad($counter++, 4, '0', STR_PAD_LEFT),
            'application_date'   => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status'             => fake()->randomElement(['pending', 'approved', 'rejected']),
            'remarks'            => fake()->optional(0.6)->sentence(),
        ];
    }
}
