<?php

use App\Models\Recipe;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

test('all of the saved recipes belonging to the user are returned', function () {
    Recipe::factory()
        ->count(3)
        ->for($this->user)
        ->create();

    $response = $this->actingAs($this->user)
        ->get('/saved')
        ->assertStatus(200);

    expect(count($response->json()))->toEqual(3);
});

test('recipes saved by a different user do not show up for the user', function () {
    Recipe::factory()
        ->count(3)
        ->for($this->user)
        ->create();

    $response = $this->actingAs(User::factory()->create())
        ->get('/saved')
        ->assertStatus(200);

    expect(count($response->json()))->toEqual(0);
});
