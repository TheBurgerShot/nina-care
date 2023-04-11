<?php

namespace Database\Seeders;

use App\Models\PersonalityTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalityTraitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalityTrait::factory(25)->create();
    }
}
