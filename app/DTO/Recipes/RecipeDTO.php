<?php

namespace App\DTO\Recipes;

class RecipeDTO
{
    public function __construct(
        readonly public string $title,
        readonly public string $summary,
        readonly public string $image,
        readonly public int $readyInMinutes,
        readonly public int $servings,
        readonly public bool $vegetarian,
        readonly public array $cuisines = [],
        readonly public string $sourceUrl,
        readonly public array $dishTypes = [],
    ) {
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'summary' => $this->summary,
            'image' => $this->image,
            'readyInMinutes' => $this->readyInMinutes,
            'servings' => $this->servings,
            'vegetarian' => $this->vegetarian,
            'cuisines' => $this->cuisines,
            'sourceUrl' => $this->sourceUrl,
            'dishTypes' => $this->dishTypes,
        ];
    }
}
