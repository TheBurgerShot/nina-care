<?php

namespace Database\Seeders;

use App\Models\DietaryWish;
use Illuminate\Database\Seeder;

class DietaryWishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DietaryWish::factory(5)->create();
    }
}
