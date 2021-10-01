<?php

namespace Database\Seeders\Inspector;

use App\Models\Inspector\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::get('id');
        if ($sites->isEmpty()) {
            Site::factory()
                ->count(10)
                ->create();
        }
    }
}
