<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamQuestionFactory extends Factory
{
    public function definition()
    {
        $type = fake()->randomElement(['multiple_choice', 'true_false', 'essay']);

        $options = null;
        $correctAnswer = null;

        if ($type === 'multiple_choice') {
            $options = [
                'A' => fake()->sentence(4),
                'B' => fake()->sentence(4),
                'C' => fake()->sentence(4),
                'D' => fake()->sentence(4),
            ];
            $correctAnswer = fake()->randomElement(['A', 'B', 'C', 'D']);
        } elseif ($type === 'true_false') {
            $options = ['A' => 'True', 'B' => 'False'];
            $correctAnswer = fake()->randomElement(['A', 'B']);
        }

        return [
            'exam_id'        => Exam::factory(),
            'question'       => fake()->sentence(10) . '?',
            'type'           => $type,
            'options'        => $options ? json_encode($options) : null,
            'correct_answer' => $correctAnswer,
            'marks'          => fake()->randomElement([2, 5, 10]),
            'order'          => fake()->numberBetween(1, 20),
        ];
    }
}
