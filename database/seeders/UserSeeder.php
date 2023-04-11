<?php

namespace Database\Seeders;

use App\Enums\ProficiencyEnum;
use App\Models\Allergy;
use App\Models\DietaryWish;
use App\Models\Language;
use App\Models\PersonalityTrait;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dietaryWishes = DietaryWish::get();
        $allergies = Allergy::get();
        $languages = Language::get();
        $personalityTraits = PersonalityTrait::get();

        User::factory(25)
            ->create()
            ->each(function (User $user) use ($allergies, $dietaryWishes, $languages, $personalityTraits) {
                /* Randomize the chance the user has one or more dietary wishes */
                if (fake()->boolean(20)) {
                    $user->dietaryWishes()->attach(
                        $dietaryWishes->random(rand(0, $dietaryWishes->count()))
                    );
                }

                /* Randomize the chance the user has one or more allergies */
                if (fake()->boolean(15)) {
                    $user->allergies()->attach(
                        $allergies->random(rand(0, $allergies->count()))
                    );
                }

                /* Every user has at least one native language */
                $nativeLanguage = $languages->random();
                $user->languages()->attach(
                    $nativeLanguage,
                    [
                        'proficiency' => ProficiencyEnum::NATIVE
                    ]
                );

                /* Randomize the chance the user knows another language */
                if (fake()->boolean(25)) {
                    $otherLanguages = $languages->except($nativeLanguage->id);

                    $otherLanguages->random(1, $otherLanguages->count())
                        ->each(fn (Language $language) => $user->languages()->attach($language, [
                            'proficiency' => Arr::random(ProficiencyEnum::cases())->value
                        ]));
                }

                /* Randomize how many personality traits the user has */
                $user->personalityTraits()->attach(
                    $personalityTraits->random(min(rand(3, 9), $personalityTraits->count()))
                );
            });
    }
}
