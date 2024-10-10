<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Capture;
use App\Models\Photobooth;
use App\Models\User;
use App\Models\Venue;
use App\Models\Remote;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        //Create Venue
        Venue::factory(5)->create();

        //Remote
        Remote::factory(10)->create();

        //User
        User::factory(10)->create();

        //create albums
        Album::factory(10)->create();

        //Capture
        Capture::factory(10)->create();

        Photobooth::factory(10)->create();

    }
}
