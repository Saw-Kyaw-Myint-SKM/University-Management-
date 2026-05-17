<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition()
    {
        $isRead = fake()->boolean(40);

        return [
            'user_id'  => User::factory(),
            'title'    => fake()->randomElement([
                'Exam Schedule Updated',
                'New Assignment Posted',
                'Result Published',
                'Attendance Warning',
                'Enrollment Approved',
                'System Maintenance Notice',
            ]),
            'message'  => fake()->sentence(12),
            'type'     => fake()->randomElement(['info', 'success', 'warning', 'error']),
            'read'     => $isRead,
            'read_at'  => $isRead ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }
}
