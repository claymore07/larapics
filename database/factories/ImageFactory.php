<?php

namespace Database\Factories;

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
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' => $title = substr(fake()->sentence(), 20),
            'slug' => str()->slug($title),
            'file' => fake()->imageUrl($width = 1920, $height = 1280),
            'dimension' => $width.'x'.$height, // 1920x1280
            'views_count' => fake()->randomNumber(5),
            'downloads_count' => fake()->randomNumber(5),
            'is_published' => true,
            'user_id' => User::factory(),
        ];
    }
}
