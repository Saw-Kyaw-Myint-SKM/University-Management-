<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    public function definition()
    {
        static $index = 0;
        $faculties = [
            ['name' => 'Faculty of Science & Technology',       'description' => 'Covers natural sciences, mathematics, and technology disciplines.'],
            ['name' => 'Faculty of Engineering',                 'description' => 'Covers civil, mechanical, electrical, and software engineering.'],
            ['name' => 'Faculty of Arts & Humanities',          'description' => 'Covers literature, history, philosophy, and fine arts.'],
            ['name' => 'Faculty of Business & Economics',       'description' => 'Covers business administration, accounting, finance, and economics.'],
            ['name' => 'Faculty of Medicine & Health Sciences', 'description' => 'Covers medicine, nursing, pharmacy, and public health.'],
        ];

        $item = $faculties[$index % count($faculties)];
        $index++;

        return [
            'name'        => $item['name'],
            'description' => $item['description'],
        ];
    }
}
