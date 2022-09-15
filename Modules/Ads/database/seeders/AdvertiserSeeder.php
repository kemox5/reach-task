<?php

namespace Modules\Ads\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Ads\App\Models\Advertiser;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertiser::factory(30)->create();
    }
}
