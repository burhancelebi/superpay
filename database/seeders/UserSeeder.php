<?php

namespace Database\Seeders;

use App\Enums\ActiveEnum;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::query()->truncate();

        User::query()->create([
            'name' => 'Emrecan',
            'surname' => 'Aslan',
            'phone' => '05333122331',
            'age' => '30',
            'email' => 'emrecan@gmail.com',
            'password' => Hash::make('emre21'),
            'active' => ActiveEnum::ACTIVE,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
