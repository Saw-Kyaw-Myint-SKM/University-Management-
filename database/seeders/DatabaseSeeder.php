<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // 1. Roles & core users
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,

            // 2. Academic structure
            FacultySeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,

            // 3. People
            TeacherSeeder::class,
            StudentSeeder::class,

            // 4. Academic operations
            AdmissionSeeder::class,
            EnrollmentSeeder::class,

            // 5. Exams & results
            ExamSeeder::class,
            ExamResultSeeder::class,

            // 6. Attendance
            AttendanceSeeder::class,

            // 7. Notifications
            NotificationSeeder::class,
        ]);
    }
}
