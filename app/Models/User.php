<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'gender' => GenderEnum::class,
        'date_of_birth' => 'date'
    ];

    /**
     * The allergies that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function allergies(): BelongsToMany
    {
        return $this->belongsToMany(Allergy::class, 'user_allergy', 'user_id', 'allergy_id');
    }

    /**
     * The dietaryWishes that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dietaryWishes(): BelongsToMany
    {
        return $this->belongsToMany(DietaryWish::class, 'user_dietary_wish', 'user_id', 'dietary_wish_id');
    }

    /**
     * The languages that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'user_language', 'user_id', 'language_id')
            ->withPivot([
                'proficiency'
            ])
            ->using(UserLanguage::class);
    }

    /**
     * The personalityTraits that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function personalityTraits(): BelongsToMany
    {
        return $this->belongsToMany(PersonalityTrait::class, 'user_personality_trait', 'user_id', 'personality_trait_id');
    }

    /**
     * Apply scope to only
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $age
     * @param int|null $maxAge
     * @return void
     */
    public function scopeAge(Builder $query, int $minAge, int $maxAge = null): void {
        $query->where(fn(Builder $q) => $q
            ->where('date_of_birth', '<', now()->subYears($minAge))
            ->where('date_of_birth', '>=', now()->subYears($maxAge ?? $minAge))
        );
    }
}
