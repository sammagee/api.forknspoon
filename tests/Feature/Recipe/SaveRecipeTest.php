<?php

use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

test('user can save a recipe', function () {
    $attributes = [
        'calories' => 1234,
        'image' => 'https://example.com/recipe-images/yummy-spaghetti.jpg',
        'label' => 'Yummy Spaghetti',
        'totalTime' => 20,
        'url' => 'https://example.com/recipes/yummy-spaghetti',
        'yield' => 4,
    ];

    $response = $this->actingAs($this->user)
        ->post('/recipes', $attributes)
        ->assertStatus(201);

    expect($this->user->recipes->count())->toEqual(1);
});
