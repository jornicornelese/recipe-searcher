<?php

use App\Http\Controllers\Api\SearchedRecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        Route::post('recipes/search', SearchedRecipeController::class)->name('recipes.search');
    });
