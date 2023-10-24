<?php

namespace App\DTO\Recipes;

class RecipeSearchDTO
{
    public function __construct(
        readonly public ?string $query,
        readonly public string $cuisine = '',
        readonly public int $maxReadyTime,
        readonly public bool $vegetarian = false,
        readonly public array $includeIngredients = [],
        readonly public array $excludeIngredients = [],
        readonly public string $type = 'main course',
    ) {
    }
}
