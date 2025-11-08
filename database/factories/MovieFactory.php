<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'release_year' => $this->faker->year(),
            'poster_url' => $this->faker->imageUrl(300, 450, 'movies', true),
        ];
    }
}
