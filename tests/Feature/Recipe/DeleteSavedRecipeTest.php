<?php

use App\Models\Recipe;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

test('deletes a saved recipe if it exists and belongs to the user', function () {
    $recipe = Recipe::factory()
        ->for($this->user)
        ->create();

    $this->actingAs($this->user)
        ->delete('/saved/'.$recipe->id)
        ->assertStatus(200);

    expect(Recipe::count())->toEqual(0);
});

test('not authorized if recipe does not belong to the user', function () {
    $newUser = User::factory()->create();
    $recipe = Recipe::factory()
        ->for($this->user)
        ->create();

    $this->actingAs($newUser)
        ->delete('/saved/'.$recipe->id)
        ->assertStatus(403);

    expect(Recipe::count())->toEqual(1);
});

test('not found if the specified recipe to delete does not exist', function () {
    Recipe::factory()
        ->for($this->user)
        ->create();

    $this->actingAs($this->user)
        ->delete('/saved/2')
        ->assertStatus(404);

    expect(Recipe::count())->toEqual(1);
});
