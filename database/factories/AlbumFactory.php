<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;
use App\Models\Remote;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        return [
            'status' => $this->faker->randomElement(['live','longterm']),
            'date_add' => now(),
            'date_over' => null,
            'date_update' => null,
            'remote_id' => Remote::all()->random()->id,
            'venue_id' =>  Venue::all()->random()->id,
        ];
    }
}
