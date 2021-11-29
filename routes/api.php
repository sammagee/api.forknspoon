<?php

use App\Http\Controllers\Auth\FetchUserController;
use App\Http\Controllers\Recipe\DeleteSavedRecipeController;
use App\Http\Controllers\Recipe\FetchRecipesController;
use App\Http\Controllers\Recipe\FetchSavedRecipesController;
use App\Http\Controllers\Recipe\SaveRecipeController;
use App\Http\Controllers\Restaurant\FetchRestaurantsController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Recipes
    Route::get('/recipes', FetchRecipesController::class);
    Route::post('/recipes', SaveRecipeController::class);
    Route::get('/saved', FetchSavedRecipesController::class);
    Route::delete('/saved/{recipe}', DeleteSavedRecipeController::class);

    // Restaurants
    Route::get('/restaurants', FetchRestaurantsController::class);

    // User
    Route::get('/user', FetchUserController::class);
});
