<?php

namespace App\Services;

use App\Exceptions\RecipeApiException;
use App\Interfaces\Recipes\RecipeSearcher;
use Illuminate\Support\Facades\Http;

class SpoonacularService implements RecipeSearcher
{
    public function __construct()
    {
        if (!config('recipes.connections.spoonacular.key')) {
            throw RecipeApiException::apikeyNotSet();
        }

        if (!config('recipes.connections.spoonacular.url')) {
            throw RecipeApiException::apiurlNotSet();
        }
    }

    public function search(string $query, int $page = 1, int $perPage = 10): array
    {
        $response = Http::get(config('recipes.connections.spoonacular.url') . '/recipes/complexSearch', [
            'apiKey' => config('recipes.connections.spoonacular.key'),
            'query' => $query,
            'includeIngredients' => 'tomato,cheese',
            'instructionsRequired' => 'true',
            'fillIngredients' => 'false',
            'addRecipeInformation' => 'true',
            'addRecipeNutrition' => 'true',
            'maxReadyTime' => 40,
            'number' => $perPage,
            'offset' => ($page - 1) * $perPage,
        ]);

        return $response->json();
    }
}
