<?php

namespace App\Http\Controllers;

use App\Enums\CuisineList;
use Inertia\Response;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Recipes/Index', [
            'cuisines' => CuisineList::cases(),
        ]);
    }
}
