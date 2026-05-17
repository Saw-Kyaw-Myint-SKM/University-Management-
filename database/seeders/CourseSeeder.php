<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Computer Science' => [
                ['code' => 'CS101', 'name' => 'Introduction to Programming',  'credits' => 3, 'description' => 'Fundamentals of programming using Python.'],
                ['code' => 'CS201', 'name' => 'Data Structures & Algorithms', 'credits' => 3, 'description' => 'Core data structures and algorithm design.'],
                ['code' => 'CS301', 'name' => 'Database Systems',             'credits' => 3, 'description' => 'Relational databases, SQL, and data modelling.'],
                ['code' => 'CS401', 'name' => 'Software Engineering',         'credits' => 3, 'description' => 'Software development lifecycle and methodologies.'],
                ['code' => 'CS501', 'name' => 'Computer Networks',            'credits' => 3, 'description' => 'Network protocols, architecture, and security.'],
            ],
            'Electrical Engineering' => [
                ['code' => 'EE101', 'name' => 'Circuit Theory',       'credits' => 3, 'description' => 'Fundamentals of electrical circuits and analysis.'],
                ['code' => 'EE201', 'name' => 'Digital Electronics',  'credits' => 3, 'description' => 'Logic gates, flip-flops, and digital systems.'],
                ['code' => 'EE301', 'name' => 'Power Systems',        'credits' => 3, 'description' => 'Generation, transmission, and distribution of power.'],
            ],
            'Mechanical Engineering' => [
                ['code' => 'ME101', 'name' => 'Engineering Mechanics', 'credits' => 3, 'description' => 'Statics and dynamics of rigid bodies.'],
                ['code' => 'ME201', 'name' => 'Thermodynamics',        'credits' => 3, 'description' => 'Laws of thermodynamics and heat transfer.'],
            ],
            'Business Administration' => [
                ['code' => 'BA101', 'name' => 'Principles of Management', 'credits' => 3, 'description' => 'Introduction to management theories and practices.'],
                ['code' => 'BA201', 'name' => 'Marketing Management',     'credits' => 3, 'description' => 'Marketing strategies, consumer behaviour, and branding.'],
                ['code' => 'BA301', 'name' => 'Strategic Management',     'credits' => 3, 'description' => 'Corporate strategy and competitive analysis.'],
            ],
            'Accounting & Finance' => [
                ['code' => 'AC101', 'name' => 'Financial Accounting', 'credits' => 3, 'description' => 'Principles of financial reporting and bookkeeping.'],
                ['code' => 'AC201', 'name' => 'Managerial Accounting', 'credits' => 3, 'description' => 'Cost accounting and management decision-making.'],
            ],
            'Mathematics' => [
                ['code' => 'MA101', 'name' => 'Calculus I',      'credits' => 3, 'description' => 'Limits, derivatives, and integrals.'],
                ['code' => 'MA201', 'name' => 'Linear Algebra',  'credits' => 3, 'description' => 'Vectors, matrices, and linear transformations.'],
            ],
        ];

        foreach ($data as $deptName => $courses) {
            $dept = Department::where('name', $deptName)->first();
            if (!$dept) continue;

            foreach ($courses as $course) {
                Course::firstOrCreate(
                    ['code' => $course['code']],
                    array_merge($course, ['department_id' => $dept->id])
                );
            }
        }

        $this->command->info('Courses seeded.');
    }
}
