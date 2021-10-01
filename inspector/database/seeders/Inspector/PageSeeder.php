<?php

namespace Database\Seeders\Inspector;

use App\Models\Inspector\Page;
use App\Models\Inspector\Site;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::get('id');
        if (!$sites->isEmpty()) {
            foreach ($sites as $site) {
                Page::factory()
                    ->count(rand(1, 100))
                    ->create(['site_id' => $site->id]);
            }
        }
    }
}
