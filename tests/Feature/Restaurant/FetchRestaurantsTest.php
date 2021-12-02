<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake(fn () => Http::response([
        'html_attributions' => [],
        'next_page_token' => 'token-abc',
        'results' => [
            [
               'business_status' => 'OPERATIONAL',
               'geometry' => [
                  'location' => [
                     'lat' => 42.0000000,
                     'lng' => -42.0000000,
                  ],
               ],
               'name' => 'Pizzas R Us',
               'opening_hours' => ['open_now' => true],
               'photos' => [
                   ['photo_reference' => 'reference-xyz'],
                ],
               'place_id' => 'reference-abc',
               'price_level' => 1,
               'rating' => 4,
               'reference' => 'reference-abc',
               'types' => ['restaurant', 'food', 'point_of_interest', 'establishment'],
            ],
         ],
        'status' => 'OK'
    ], 200));

    $this->user = User::factory()->create();
});

test('fetches restaurants from api', function () {
    $response = $this->actingAs($this->user)
        ->get('/restaurants')
        ->assertStatus(200);

    expect(count($response->json()))->toEqual(1);
});

test('redirects if not authenticated', function () {
    $this->get('/recipes')->assertStatus(302);
});
