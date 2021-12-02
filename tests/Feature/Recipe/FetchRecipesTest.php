<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake(fn () => Http::response([
        'from' => 1,
        'to' => 1,
        'count' => 1,
        'hits' => [
            [
                'recipe' => [
                    'label' => 'Chocolate clusters',
                    'image' => 'https://www.edamam.com/web-img/d12/d127533aac0c5f37ba911a2073b96989.jpeg',
                    'url' => 'https://www.taste.com.au/recipes/chocolate-clusters/6219fe5e-4b4a-4cf9-949a-3882722f38e6',
                    'yield' => 24.0,
                    'calories' => 1234.0,
                    'totalTime' => 30.0,
                    'cuisineType' => ['american'],
                    'mealType' => ['lunch/dinner'],
                ],
            ],
        ],
    ], 200));

    $this->user = User::factory()->create();
});

test('fetches recipes from api', function () {
    $response = $this->actingAs($this->user)
        ->get('/recipes')
        ->assertStatus(200);

    expect(count($response->json()))->toEqual(1);
});

test('redirects if not authenticated', function () {
    $this->get('/recipes')->assertStatus(302);
});
