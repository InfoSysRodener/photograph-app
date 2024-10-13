<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Album;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capture>
 */
class CaptureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => 'https://uicookies.com/demo/theme/aside/images/img_' . fake()->numberBetween(1,20) . '.jpg' ,
            'album_id' => Album::all()->random()->id,
        ];
    }
}
