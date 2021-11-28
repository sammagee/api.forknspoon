<?php

use App\Http\Controllers\FetchRecipesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/recipes', FetchRecipesController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
