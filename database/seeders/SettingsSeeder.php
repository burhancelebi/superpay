<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::query()->truncate();

        $settings = [
            [
                'key' => 'site-title',
                'value' => 'Süper Pay',
            ],
            [
                'key' => 'logo-image',
                'value' => asset('assets/media/logos/project-logo.jpg'),
            ],
            [
                'key' => 'logo-title',
                'value' => 'Süper Pay',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::query()->create($setting);
        }
    }
}
