<?php

namespace App\Http\Requests\Recipes;

use App\Enums\CuisineList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SearchRecipeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'nullable|string|max:255',
            'cuisine' => ['nullable', 'string', new Enum(CuisineList::class)],
            'maxReadyTime' => 'integer|min:0',
            'includeIngredients' => 'array',
            'excludeIngredients' => 'array',
            'vegetarian' => 'boolean',
            'type' => 'string|min:3|max:255',
        ];
    }
}
