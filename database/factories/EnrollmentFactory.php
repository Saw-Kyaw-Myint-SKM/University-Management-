<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition()
    {
        return [
            'student_id'    => Student::factory(),
            'course_id'     => Course::factory(),
            'teacher_id'    => Teacher::factory(),
            'semester'      => fake()->randomElement(['Semester 1', 'Semester 2', 'Semester 3']),
            'academic_year' => fake()->randomElement(['2023/2024', '2024/2025', '2025/2026']),
            'status'        => fake()->randomElement(['active', 'completed', 'dropped']),
            'enrollment_date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];
    }
}
