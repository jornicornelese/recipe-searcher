<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Recipes\RecipeSearcher;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RecipeSearcher::class, function (Application $app) {
            $class = match (config('recipes.default')) {
                'spoonacular' => \App\Services\SpoonacularService::class,
                default => throw new Exception('Invalid recipe searcher'),
            };
            return $app->make($class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
