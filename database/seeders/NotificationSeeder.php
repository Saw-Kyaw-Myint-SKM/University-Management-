<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Skipping notifications.');
            return;
        }

        $templates = [
            ['title' => 'Welcome to the University System',  'type' => 'info',    'message' => 'Your account has been created successfully. Please complete your profile.'],
            ['title' => 'Exam Schedule Published',           'type' => 'info',    'message' => 'The exam schedule for this semester has been published. Please check your timetable.'],
            ['title' => 'Enrollment Approved',               'type' => 'success', 'message' => 'Your course enrollment has been approved by the administrator.'],
            ['title' => 'Attendance Warning',                'type' => 'warning', 'message' => 'Your attendance has dropped below 80%. Please attend classes regularly.'],
            ['title' => 'Result Published',                  'type' => 'success', 'message' => 'Your exam results have been published. Please check your results.'],
            ['title' => 'System Maintenance',                'type' => 'warning', 'message' => 'The system will undergo maintenance on Sunday from 2:00 AM to 4:00 AM.'],
        ];

        foreach ($users as $user) {
            // 2–4 notifications per user
            $count = fake()->numberBetween(2, 4);
            $selected = fake()->randomElements($templates, min($count, count($templates)));

            foreach ($selected as $tpl) {
                $isRead = fake()->boolean(50);
                Notification::create([
                    'user_id'  => $user->id,
                    'title'    => $tpl['title'],
                    'message'  => $tpl['message'],
                    'type'     => $tpl['type'],
                    'read'     => $isRead,
                    'read_at'  => $isRead ? fake()->dateTimeBetween('-1 month', 'now') : null,
                ]);
            }
        }

        $this->command->info('Notifications seeded.');
    }
}
