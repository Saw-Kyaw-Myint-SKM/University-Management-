<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();
        $courses  = Course::all();
        $teachers = Teacher::all();

        if ($students->isEmpty() || $courses->isEmpty() || $teachers->isEmpty()) {
            $this->command->warn('Students, courses, or teachers missing. Skipping enrollments.');
            return;
        }

        $semesters     = ['Semester 1', 'Semester 2'];
        $academicYears = ['2024/2025', '2025/2026'];

        foreach ($students as $student) {
            // Each student enrolls in 3–5 random courses
            $enrollCourses = $courses->random(min(fake()->numberBetween(3, 5), $courses->count()));

            foreach ($enrollCourses as $course) {
                Enrollment::firstOrCreate(
                    ['student_id' => $student->id, 'course_id' => $course->id],
                    [
                        'teacher_id'      => $teachers->random()->id,
                        'semester'        => fake()->randomElement($semesters),
                        'academic_year'   => fake()->randomElement($academicYears),
                        'status'          => fake()->randomElement(['active', 'active', 'active', 'completed']),
                        'enrollment_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                    ]
                );
            }
        }

        $this->command->info('Enrollments seeded.');
    }
}
