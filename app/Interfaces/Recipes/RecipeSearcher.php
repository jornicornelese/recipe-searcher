<?php

namespace App\Interfaces\Recipes;

use App\DTO\Recipes\RecipeDTO;
use Illuminate\Support\Collection;
use App\DTO\Recipes\RecipeSearchDTO;

interface RecipeSearcher
{
    /**
     * @param RecipeSearchDTO $searchDTO
     * @return Collection<RecipeDTO> $recipes
     */
    public function search(RecipeSearchDTO $searchDTO): Collection;
}
