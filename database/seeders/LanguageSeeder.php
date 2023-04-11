<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory()->createMany([
            [
                'name' => 'Dutch'
            ],
            [
                'name' => 'English'
            ],
            [
                'name' => 'Spanish'
            ],
            [
                'name' => 'French'
            ],
            [
                'name' => 'Portuguese'
            ],
            [
                'name' => 'German'
            ],
            [
                'name' => 'Italian'
            ],
        ]);
    }
}
