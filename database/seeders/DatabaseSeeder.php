<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run destinations first, then packages
        $this->call([
            DestinationSeeder::class,
            TravelPackageSeeder::class,
        ]);
    }
}