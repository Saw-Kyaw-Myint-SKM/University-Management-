<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Database\Seeder;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        $completedExams = Exam::where('status', 'completed')->with('course')->get();

        if ($completedExams->isEmpty()) {
            $this->command->warn('No completed exams found. Skipping results.');
            return;
        }

        foreach ($completedExams as $exam) {
            // Get students enrolled in this course
            $enrollments = Enrollment::where('course_id', $exam->course_id)->get();

            foreach ($enrollments as $enrollment) {
                if (ExamResult::where('exam_id', $exam->id)->where('student_id', $enrollment->student_id)->exists()) {
                    continue;
                }

                $obtained   = fake()->numberBetween(30, $exam->total_marks);
                $percentage = ($obtained / $exam->total_marks) * 100;

                if ($percentage >= 80)      $grade = 'A';
                elseif ($percentage >= 70)  $grade = 'B';
                elseif ($percentage >= 60)  $grade = 'C';
                elseif ($percentage >= 50)  $grade = 'D';
                else                        $grade = 'F';

                ExamResult::create([
                    'exam_id'        => $exam->id,
                    'student_id'     => $enrollment->student_id,
                    'obtained_marks' => $obtained,
                    'grade'          => $grade,
                    'remarks'        => fake()->optional(0.4)->sentence(),
                    'submitted_at'   => $exam->end_time,
                ]);
            }
        }

        $this->command->info('Exam results seeded.');
    }
}
