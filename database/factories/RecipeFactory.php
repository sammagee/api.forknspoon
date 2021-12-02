<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'calories' => $this->faker->randomFloat(),
            'image' => $this->faker->imageUrl(1920, 1080, word: 'Recipe'),
            'label' => $this->faker->sentence(),
            'total_time' => $this->faker->numberBetween(0, 120),
            'url' => $this->faker->url(),
            'yield' => $this->faker->randomDigitNotNull(),
        ];
    }
}
