<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition()
    {
        static $counter = 1;

        return [
            'user_id'         => User::factory()->state(['role_id' => 2]),
            'department_id'   => Department::factory(),
            'employee_number' => 'EMP-' . str_pad($counter++, 4, '0', STR_PAD_LEFT),
            'specialization'  => fake()->randomElement([
                'Computer Science', 'Mathematics', 'Physics',
                'Electrical Engineering', 'Mechanical Engineering',
                'Business Administration', 'Accounting', 'Civil Engineering',
            ]),
            'phone'           => fake()->numerify('+60 1#-#### ####'),
            'address'         => fake()->address(),
            'status'          => 'active',
        ];
    }
}
