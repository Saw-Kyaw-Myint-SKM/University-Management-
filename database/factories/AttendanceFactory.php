<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition()
    {
        return [
            'enrollment_id' => Enrollment::factory(),
            'date'          => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'status'        => fake()->randomElement(['present', 'absent', 'late', 'excused']),
            'remarks'       => fake()->optional(0.3)->sentence(),
        ];
    }
}
