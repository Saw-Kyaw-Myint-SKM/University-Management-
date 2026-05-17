<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        static $counter = 1;

        return [
            'user_id'        => User::factory()->state(['role_id' => 3]),
            'department_id'  => Department::factory(),
            'student_number' => 'STD-' . str_pad($counter++, 4, '0', STR_PAD_LEFT),
            'date_of_birth'  => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'phone'          => fake()->numerify('+60 1#-#### ####'),
            'address'        => fake()->address(),
            'status'         => 'active',
        ];
    }
}
