<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    public function definition()
    {
        return [
            'key'         => fake()->unique()->slug(2),
            'value'       => fake()->word(),
            'type'        => 'string',
            'group'       => fake()->randomElement(['general', 'academic', 'system']),
            'description' => fake()->sentence(),
        ];
    }
}
