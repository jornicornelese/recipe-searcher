<?php

namespace App\Interfaces\Recipes;

interface RecipeSearcher
{
    public function search(string $query, int $page = 1, int $perPage = 10): array;
}
