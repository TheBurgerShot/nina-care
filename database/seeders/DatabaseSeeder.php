<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DietaryWishSeeder::class);
        $this->call(AllergySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(PersonalityTraitSeeder::class);
        $this->call(UserSeeder::class);
    }
}
