<?php

namespace Database\Seeders;


use Database\Seeders\Inspector\CodeSeeder;
use Database\Seeders\Inspector\DomainSeeder;
use Database\Seeders\Inspector\PageSeeder;
use Database\Seeders\Inspector\ServerSeeder;
use Database\Seeders\Inspector\SiteSeeder;
use Database\Seeders\Inspector\SpeedSeeder;
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
        $this->call([
            SiteSeeder::class,
            DomainSeeder::class,
            ServerSeeder::class,
            CodeSeeder::class,
            SpeedSeeder::class,
            PageSeeder::class
        ]);
    }
}
