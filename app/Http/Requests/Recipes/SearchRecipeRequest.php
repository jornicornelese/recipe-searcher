<?php

namespace App\Http\Requests\Recipes;

use Illuminate\Foundation\Http\FormRequest;

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
            'query' => 'string|min:3|max:255',
            'cuisine' => 'string|min:3|max:255',
            'includeIngredients' => 'array',
            'excludeIngredients' => 'array',
            'type' => 'string|min:3|max:255',
        ];
    }
}
