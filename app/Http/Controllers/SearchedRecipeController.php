<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Interfaces\Recipes\RecipeSearcher;
use App\Http\Requests\Recipes\SearchRecipeRequest;

class SearchedRecipeController extends Controller
{
    public function __construct(
        protected RecipeSearcher $recipeSearcher
    ) {
    }

    public function search(SearchRecipeRequest $request): RecipeResource
    {
        $recipe = collect($this->recipeSearcher->search(
            query: $request->query('query')
        )['results'])->shuffle()->first();

        abort_if(!$recipe, 404, 'No recipe found');

        return RecipeResource::make($recipe);
    }
}
