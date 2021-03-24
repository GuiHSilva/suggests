<?php

namespace Database\Factories;

use App\Models\Suggest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuggestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suggest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->name(),
            'content'   => $this->faker->text(),
            'author'    => random_int(0, 1) == 1 ? User::all()->random()->id : null,
            'viewed'     => random_int(0, 1) == 1 ? true : false,
            'public'    => random_int(0, 1) == 1 ? true : false,
            'deleted_by'=> null
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
