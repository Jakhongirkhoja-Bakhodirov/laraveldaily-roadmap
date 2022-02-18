<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url(),
            // 'imageable_id' => User::all()->random()->id,
            // 'imageable_type' => User::class
            'imageable_id' => Post::all()->random()->id,
            'imageable_type' => Post::class
        ];
    }
}
