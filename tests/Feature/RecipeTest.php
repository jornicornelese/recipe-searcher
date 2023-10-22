<?php

use App\Interfaces\Recipes\RecipeSearcher;
use App\Models\User;

use function PHPUnit\Framework\assertJson;

test('recipes page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/recipes');

    $response->assertOk();
});

test('user can search for recipes', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/api/recipes/search', [
            'query' => 'chicken',
            'cuisine' => 'italian',
            'type' => 'main course',
            'maxReadyTime' => 60,
            'vegetarian' => false,
        ]);

    $response->assertOk();
});
