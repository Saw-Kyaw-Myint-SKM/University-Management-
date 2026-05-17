<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'University Management System',
                'type' => 'string',
                'group' => 'general',
                'description' => 'The name of the site'
            ],
            [
                'key' => 'academic_year',
                'value' => date('Y') . '-' . (date('Y') + 1),
                'type' => 'string',
                'group' => 'academic',
                'description' => 'Current academic year'
            ],
            [
                'key' => 'semester',
                'value' => '1',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Current semester'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
