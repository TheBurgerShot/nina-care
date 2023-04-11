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
            'age' => $this->age,
            'bio' => $this->bio,
            'dietary_wishes' => $this->dietaryWishes->pluck('name'),
            'allergies' => $this->allergies->pluck('name'),
            'personality_traits' => $this->personalityTraits->pluck('name'),
            'languages' => LanguageResource::collection($this->languages),
        ];
    }
}
