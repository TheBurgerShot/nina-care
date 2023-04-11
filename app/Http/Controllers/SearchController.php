<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    /**
     * Handle the incoming request
     *
     * @param \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SearchRequest $request)
    {
        $users = User::query()
            ->when($request->gender,
                fn(Builder $q, $gender) => $q->where('gender', $gender)
            )
            ->when($request->age,
                fn(Builder $q, $ageRange) => $q->age($ageRange[0], $ageRange[1]) /* Assuming an age range is provided */
            )
            ->when($request->allergies,
                fn(Builder $q, $allergiesIds) => $q->whereHas('allergies', fn(Builder $q) => $q->whereKey($allergiesIds))
            )
            ->when($request->dietary_wishes,
                fn(Builder $q, $dietaryWishesIds) => $q->whereHas('dietaryWishes', fn(Builder $q) => $q->whereKey($dietaryWishesIds))
            )
            ->when($request->language,
                fn(Builder $q, $languageId) => $q->whereHas('languages',
                    fn(Builder $q) => $q->whereKey($languageId)->wherePivot('proficiency', $request->language_proficiency)
                )
            )
            ->when($request->personality_traits,
                fn(Builder $q, $personalityTraitIds) => $q->whereHas('personalityTraits', fn(Builder $q) => $q->whereKey($personalityTraitIds))
            )
            ->get();

        return UserResource::collection($users);
    }
}
