<?php

namespace App\Services;

use App\DTO\RecipeSearchDTO;
use Illuminate\Support\Facades\Http;
use App\Exceptions\RecipeApiException;
use App\Interfaces\Recipes\RecipeSearcher;

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

    /**
     * Search for recipes using the Spoonacular Complex Search API.
     * Returns an array of recipes
     *
     * @param RecipeSearchDTO $dto
     * @return array $recipes
     */
    public function search(RecipeSearchDTO $dto): array
    {
        $response = Http::get(config('recipes.connections.spoonacular.url') . '/recipes/complexSearch', [
            'apiKey' => config('recipes.connections.spoonacular.key'),
            'query' => $dto->query,
            'includeIngredients' => implode(',', $dto->includeIngredients),
            'excludeIngredients' => implode(',', $dto->excludeIngredients),
            'cuisine' => $dto->cuisine,
            'type' => $dto->type,
            'maxReadyTime' => $dto->maxReadyTime,
            'diet' => $dto->vegetarian ? 'vegetarian' : '',
            'instructionsRequired' => 'true',
            'fillIngredients' => 'false',
            'addRecipeInformation' => 'true',
            'addRecipeNutrition' => 'true',
            'number' => 100,
        ]);

        return $response->json();
    }
}
