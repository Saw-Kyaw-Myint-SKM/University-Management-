<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run()
    {
        $faculties = [
            ['name' => 'Faculty of Science & Technology',       'description' => 'Covers natural sciences, mathematics, and technology disciplines.'],
            ['name' => 'Faculty of Engineering',                 'description' => 'Covers civil, mechanical, electrical, and software engineering.'],
            ['name' => 'Faculty of Arts & Humanities',          'description' => 'Covers literature, history, philosophy, and fine arts.'],
            ['name' => 'Faculty of Business & Economics',       'description' => 'Covers business administration, accounting, finance, and economics.'],
            ['name' => 'Faculty of Medicine & Health Sciences', 'description' => 'Covers medicine, nursing, pharmacy, and public health.'],
        ];

        foreach ($faculties as $faculty) {
            Faculty::firstOrCreate(['name' => $faculty['name']], $faculty);
        }

        $this->command->info('Faculties seeded.');
    }
}
