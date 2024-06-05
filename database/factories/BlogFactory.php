<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'=>Category::factory(),
            'user_id'=>User::factory(),
            'title'=>$this->faker->sentence(),
            'thumbnail'=>'https://i.pravatar.cc/150?img=3'.$this->faker->randomNumber(1,100),
            'slug'=>$this->faker->slug(),
            'intro'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph()
        ];
    }
}
