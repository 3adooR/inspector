<?php

namespace Database\Seeders\Inspector;

use App\Models\Inspector\Speed;
use App\Models\Inspector\Site;
use Illuminate\Database\Seeder;

class SpeedSeeder extends Seeder
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
                Speed::factory()->create(['site_id' => $site->id]);
            }
        }
    }
}
