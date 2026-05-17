<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $enrollments = Enrollment::where('status', 'active')->get();

        if ($enrollments->isEmpty()) {
            $this->command->warn('No active enrollments found. Skipping attendance.');
            return;
        }

        $statuses = ['present', 'present', 'present', 'present', 'absent', 'late', 'excused'];

        foreach ($enrollments as $enrollment) {
            // 10 attendance records per enrollment (last 10 weeks)
            for ($week = 10; $week >= 1; $week--) {
                $date = now()->subWeeks($week)->format('Y-m-d');

                Attendance::firstOrCreate(
                    ['enrollment_id' => $enrollment->id, 'date' => $date],
                    [
                        'status'  => fake()->randomElement($statuses),
                        'remarks' => fake()->optional(0.2)->sentence(),
                    ]
                );
            }
        }

        $this->command->info('Attendance seeded.');
    }
}
