<?php

namespace App\Http\Controllers\Api;

use App\DTO\RecipeSearchDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Interfaces\Recipes\RecipeSearcher;
use App\Http\Requests\Recipes\SearchRecipeRequest;

class SearchedRecipeController extends Controller
{
    public function __construct(
        protected RecipeSearcher $recipeSearcher
    ) {
    }

    /**
     * Return a random recipe based on the search criteria
     */
    public function __invoke(SearchRecipeRequest $request): RecipeResource
    {
        $dto = new RecipeSearchDTO(
            query: $request->validated('query'),
            cuisine: $request->validated('cuisine') ?: '',
            maxReadyTime: $request->validated('maxReadyTime'),
            vegetarian: $request->validated('vegetarian') ?: false,
            includeIngredients: $request->validated('includeIngredients') ?: [],
            excludeIngredients: $request->validated('excludeIngredients') ?: [],
            type: $request->validated('type') ?: 'main course',
        );

        $recipe = collect($this->recipeSearcher->search($dto)['results'])->shuffle()->first();

        abort_if(!$recipe, 404, 'No recipe found');

        return RecipeResource::make($recipe);
    }
}
