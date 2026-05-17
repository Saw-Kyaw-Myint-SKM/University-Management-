<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('No courses found. Skipping exams.');
            return;
        }

        foreach ($courses as $course) {
            // 1–2 exams per course
            $examCount = fake()->numberBetween(1, 2);

            for ($e = 0; $e < $examCount; $e++) {
                $start = fake()->dateTimeBetween('-3 months', '+2 months');
                $duration = fake()->randomElement([60, 90, 120]);
                $end = (clone $start)->modify("+{$duration} minutes");

                $exam = Exam::create([
                    'course_id'   => $course->id,
                    'title'       => fake()->randomElement(['Midterm', 'Final', 'Quiz']) . ' — ' . $course->name,
                    'description' => fake()->optional(0.6)->sentence(),
                    'start_time'  => $start,
                    'end_time'    => $end,
                    'duration'    => $duration,
                    'total_marks' => 100,
                    'status'      => fake()->randomElement(['draft', 'published', 'completed']),
                ]);

                // 5 questions per exam
                for ($q = 1; $q <= 5; $q++) {
                    $type = fake()->randomElement(['multiple_choice', 'true_false', 'essay']);
                    $options = null;
                    $correctAnswer = null;

                    if ($type === 'multiple_choice') {
                        $options = json_encode([
                            'A' => fake()->sentence(4),
                            'B' => fake()->sentence(4),
                            'C' => fake()->sentence(4),
                            'D' => fake()->sentence(4),
                        ]);
                        $correctAnswer = fake()->randomElement(['A', 'B', 'C', 'D']);
                    } elseif ($type === 'true_false') {
                        $options = json_encode(['A' => 'True', 'B' => 'False']);
                        $correctAnswer = fake()->randomElement(['A', 'B']);
                    }

                    ExamQuestion::create([
                        'exam_id'        => $exam->id,
                        'question'       => fake()->sentence(8) . '?',
                        'type'           => $type,
                        'options'        => $options,
                        'correct_answer' => $correctAnswer,
                        'marks'          => 20,
                        'order'          => $q,
                    ]);
                }
            }
        }

        $this->command->info('Exams and questions seeded.');
    }
}
