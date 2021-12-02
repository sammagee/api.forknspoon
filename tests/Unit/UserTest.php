<?php

use App\Models\Recipe;
use App\Models\User;

it('gets initials', function () {
    $johnSmith = User::factory()->create(['name' => 'John Smith']);
    expect($johnSmith->initials)->toEqual('JS');

    $john = User::factory()->create(['name' => 'John']);
    expect($john->initials)->toEqual('J');
});

it('has saved recipes', function () {
    $john = User::factory()
        ->has(Recipe::factory()->count(3))
        ->create(['name' => 'John']);
    expect($john->recipes)->toHaveCount(3);
});
