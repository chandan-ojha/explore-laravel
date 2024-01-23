<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\Conference::factory(5)->create();

        $talks = \App\Models\Talk::factory(5)->create();
        $talks->each(function ($talk) {
            $speaker = \App\Models\Speaker::factory()->create();
            $talk->speaker()->associate($speaker);
            $talk->save();
        });

    }
}
