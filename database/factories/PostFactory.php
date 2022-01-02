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
            'title'=> $this->faker->realText(10),
            'content'=> $this->faker->realText(50),
            'status'=> $this->faker->randomElement(array('published', 'draft')),
            'catagory_id'=> $this->faker->numberBetween(1,5),
            'user_id'=> $this->faker->numberBetween(1,1)
        ];
    }
}
