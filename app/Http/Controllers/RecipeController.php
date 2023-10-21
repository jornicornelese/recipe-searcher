<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Recipes/Index');
    }
}
