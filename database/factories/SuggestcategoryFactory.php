<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Suggest;
use App\Models\SuggestCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuggestcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuggestCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'suggest_id'=> Suggest::all()->random()->id,
            'category_id'=> Category::all()->random()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
