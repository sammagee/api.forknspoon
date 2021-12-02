<?php

use App\Models\Recipe;
use App\Models\User;

it('belongs to a user', function () {
    $user = User::factory()->create();
    $recipes = Recipe::factory()
        ->count(3)
        ->for($user)
        ->create();

    $recipes->map(fn ($recipe) =>
        expect($recipe->user_id)->toEqual($user->id));
});
