<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        $courses = [
            ['code' => 'CS101',  'name' => 'Introduction to Programming',       'credits' => 3],
            ['code' => 'CS201',  'name' => 'Data Structures & Algorithms',       'credits' => 3],
            ['code' => 'CS301',  'name' => 'Database Systems',                   'credits' => 3],
            ['code' => 'CS401',  'name' => 'Software Engineering',               'credits' => 3],
            ['code' => 'EE101',  'name' => 'Circuit Theory',                     'credits' => 3],
            ['code' => 'EE201',  'name' => 'Digital Electronics',                'credits' => 3],
            ['code' => 'ME101',  'name' => 'Engineering Mechanics',              'credits' => 3],
            ['code' => 'ME201',  'name' => 'Thermodynamics',                     'credits' => 3],
            ['code' => 'BA101',  'name' => 'Principles of Management',           'credits' => 3],
            ['code' => 'BA201',  'name' => 'Marketing Management',               'credits' => 3],
            ['code' => 'AC101',  'name' => 'Financial Accounting',               'credits' => 3],
            ['code' => 'MA101',  'name' => 'Calculus I',                         'credits' => 3],
            ['code' => 'MA201',  'name' => 'Linear Algebra',                     'credits' => 3],
            ['code' => 'PH101',  'name' => 'General Physics',                    'credits' => 3],
            ['code' => 'CE101',  'name' => 'Structural Analysis',                'credits' => 3],
        ];

        $item = fake()->unique()->randomElement($courses);

        return [
            'department_id' => Department::factory(),
            'code'          => $item['code'],
            'name'          => $item['name'],
            'description'   => fake()->sentence(10),
            'credits'       => $item['credits'],
        ];
    }
}
