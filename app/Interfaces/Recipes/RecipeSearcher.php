<?php

namespace App\Interfaces\Recipes;

use App\DTO\RecipeSearchDTO;

interface RecipeSearcher
{
    public function search(RecipeSearchDTO $searchDTO): array;
}
