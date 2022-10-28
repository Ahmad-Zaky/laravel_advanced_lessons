<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * DONE
         */
        // $this->call(PostSeeder::class);
        // $this->call(CustomerSeeder::class);
        $this->call(ContestEntrySeeder::class);

        
    }
}
