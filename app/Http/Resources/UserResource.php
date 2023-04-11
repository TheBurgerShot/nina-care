<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth->toDateString(),
            'bio' => $this->bio,
            'dietary_wishes' => DietaryWishResource::collection($this->dietaryWishes),
            'allergies' => AllergyResource::collection($this->allergies),
            'personality_traits' => PersonalityTraitResource::collection($this->personalityTraits),
            'languages' => LanguageResource::collection($this->languages),
        ];
    }
}
