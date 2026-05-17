<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    public function definition()
    {
        $start = fake()->dateTimeBetween('-6 months', '+3 months');
        $end   = (clone $start)->modify('+' . fake()->randomElement([60, 90, 120, 180]) . ' minutes');

        return [
            'course_id'   => Course::factory(),
            'title'       => fake()->randomElement([
                'Midterm Examination', 'Final Examination',
                'Quiz 1', 'Quiz 2', 'Assignment Test', 'Practical Exam',
            ]) . ' — ' . fake()->words(2, true),
            'description' => fake()->optional(0.7)->sentence(),
            'start_time'  => $start,
            'end_time'    => $end,
            'duration'    => fake()->randomElement([60, 90, 120, 180]),
            'total_marks' => fake()->randomElement([50, 100]),
            'status'      => fake()->randomElement(['draft', 'published', 'completed']),
        ];
    }
}
