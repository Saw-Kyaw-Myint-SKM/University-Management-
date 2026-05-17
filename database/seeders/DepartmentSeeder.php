<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Faculty of Science & Technology' => [
                ['name' => 'Computer Science',    'description' => 'Study of computation, algorithms, and software systems.'],
                ['name' => 'Mathematics',          'description' => 'Study of pure and applied mathematics.'],
                ['name' => 'Physics',              'description' => 'Study of matter, energy, and fundamental forces.'],
            ],
            'Faculty of Engineering' => [
                ['name' => 'Electrical Engineering', 'description' => 'Study of electrical systems, circuits, and electronics.'],
                ['name' => 'Mechanical Engineering', 'description' => 'Study of mechanical systems, thermodynamics, and manufacturing.'],
                ['name' => 'Civil Engineering',      'description' => 'Study of infrastructure, structures, and environmental engineering.'],
            ],
            'Faculty of Business & Economics' => [
                ['name' => 'Business Administration', 'description' => 'Study of management, strategy, and organisational behaviour.'],
                ['name' => 'Accounting & Finance',    'description' => 'Study of financial reporting, auditing, and corporate finance.'],
            ],
        ];

        foreach ($data as $facultyName => $departments) {
            $faculty = Faculty::where('name', $facultyName)->first();
            if (!$faculty) continue;

            foreach ($departments as $dept) {
                Department::firstOrCreate(
                    ['name' => $dept['name']],
                    array_merge($dept, ['faculty_id' => $faculty->id])
                );
            }
        }

        $this->command->info('Departments seeded.');
    }
}
