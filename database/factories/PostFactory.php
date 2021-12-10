<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->name(),
            'content'=> $this->faker->realText(50),
            'status'=> $this->faker->randomElement(array('published', 'draft'))
        ];
    }
}
