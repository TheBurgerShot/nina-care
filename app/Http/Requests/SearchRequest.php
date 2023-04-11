<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'gender' => ['nullable', Rule::in(GenderEnum::values())],
            'age' => 'nullable|array|size:2',
            'age.*' => 'integer|min:18|max:25',
            'allergies' => 'nullable|array',
            'allergies.*' => 'exists:allergies,id',
            'dietary_wishes' => 'nullable|array',
            'dietary_wishes.*' => 'exists:dietary_wishes,id',
            'language' => 'nullable|exists:languages,id',
            'personality_traits' => 'nullable|array',
            'personality_traits.*' => 'exists:personality_traits,id',
        ];
    }
}
