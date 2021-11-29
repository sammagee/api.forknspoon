<?php

use App\Http\Controllers\DeleteSavedRecipeController;
use App\Http\Controllers\FetchRecipesController;
use App\Http\Controllers\FetchSavedRecipesController;
use App\Http\Controllers\SaveRecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/recipes', FetchRecipesController::class);
    Route::post('/recipes', SaveRecipeController::class);
    Route::get('/saved', FetchSavedRecipesController::class);
    Route::delete('/saved/{recipe}', DeleteSavedRecipeController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
