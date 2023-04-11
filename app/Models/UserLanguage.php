<?php

namespace App\Models;

use App\Enums\ProficiencyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserLanguage extends Pivot
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'proficiency' => ProficiencyEnum::class
    ];
}
