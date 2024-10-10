<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>  fake()->unique()->randomElement([
                'The Curiosity Gallery',
                'Heritage Hall' , 
                'Cultural Crossroads',
                'The Time Capsule Museum',
                'Legacy Lounge', 'The Imagination Center' 
            ])
        ];
    }
}
