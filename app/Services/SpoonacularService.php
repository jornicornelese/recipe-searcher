<?php

namespace App\Services;

use App\DTO\Recipes\RecipeDTO;
use App\DTO\Recipes\RecipeSearchDTO;
use Illuminate\Support\Facades\Http;
use App\Exceptions\RecipeApiException;
use App\Interfaces\Recipes\RecipeSearcher;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;

class SpoonacularService implements RecipeSearcher
{
    protected PendingRequest $client;

    public function __construct()
    {
        if (!config('recipes.connections.spoonacular.key')) {
            throw RecipeApiException::apikeyNotSet();
        }

        if (!config('recipes.connections.spoonacular.url')) {
            throw RecipeApiException::apiurlNotSet();
        }

        $this->client = Http::baseUrl(config('recipes.connections.spoonacular.url'));

        $this->client->withHeaders([
            'Accept' => 'application/json',
        ]);
    }

    /**
     * Search for recipes using the Spoonacular Complex Search API.
     * Returns a collection of RecipeDTOs.
     *
     * @param RecipeSearchDTO $dto
     * @return RecipeDTO[] $recipes
     * 
     * @throws RecipeApiException
     */
    public function search(RecipeSearchDTO $dto): Collection
    {
        $response = $this->client->get('/recipes/complexSearch', [
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

        if ($response->failed()) {
            throw RecipeApiException::apiRequestFailed($response->json()['message']);
        }

        return collect($response->json()['results'])
            ->map(fn ($recipe) => new RecipeDTO(
                title: $recipe['title'],
                image: $recipe['image'],
                servings: $recipe['servings'],
                readyInMinutes: $recipe['readyInMinutes'],
                sourceUrl: $recipe['sourceUrl'],
                summary: $recipe['summary'],
                vegetarian: $recipe['vegetarian'],
                cuisines: $recipe['cuisines'],
                dishTypes: $recipe['dishTypes'],
            ));
    }
}
