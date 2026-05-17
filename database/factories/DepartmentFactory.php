<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition()
    {
        $departments = [
            ['name' => 'Computer Science',          'description' => 'Study of computation, algorithms, and software systems.'],
            ['name' => 'Electrical Engineering',    'description' => 'Study of electrical systems, circuits, and electronics.'],
            ['name' => 'Mechanical Engineering',    'description' => 'Study of mechanical systems, thermodynamics, and manufacturing.'],
            ['name' => 'Business Administration',   'description' => 'Study of management, strategy, and organisational behaviour.'],
            ['name' => 'Accounting & Finance',      'description' => 'Study of financial reporting, auditing, and corporate finance.'],
            ['name' => 'Mathematics',               'description' => 'Study of pure and applied mathematics.'],
            ['name' => 'Physics',                   'description' => 'Study of matter, energy, and the fundamental forces of nature.'],
            ['name' => 'Civil Engineering',         'description' => 'Study of infrastructure, structures, and environmental engineering.'],
        ];

        $item = fake()->unique()->randomElement($departments);

        return [
            'faculty_id'  => Faculty::factory(),
            'name'        => $item['name'],
            'description' => $item['description'],
        ];
    }
}
