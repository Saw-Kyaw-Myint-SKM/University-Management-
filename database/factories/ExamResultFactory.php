<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamResultFactory extends Factory
{
    public function definition()
    {
        $totalMarks    = fake()->randomElement([50, 100]);
        $obtainedMarks = fake()->numberBetween(0, $totalMarks);
        $percentage    = ($obtainedMarks / $totalMarks) * 100;

        if ($percentage >= 80)      $grade = 'A';
        elseif ($percentage >= 70)  $grade = 'B';
        elseif ($percentage >= 60)  $grade = 'C';
        elseif ($percentage >= 50)  $grade = 'D';
        else                        $grade = 'F';

        return [
            'exam_id'        => Exam::factory(),
            'student_id'     => Student::factory(),
            'obtained_marks' => $obtainedMarks,
            'grade'          => $grade,
            'remarks'        => fake()->optional(0.5)->sentence(),
            'submitted_at'   => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
