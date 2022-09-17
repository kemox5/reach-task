<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Ads\App\Models\Ad;
use Modules\Ads\App\Models\Advertiser;
use Modules\Ads\App\Models\Category;
use Modules\Ads\App\Models\Tag;
use Modules\Ads\Database\Seeders\AdvertiserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Advertiser::factory(5)->create();
        Tag::factory(30)->create();
        // Category::factory(5)->create();

        Ad::factory(120)->create()->each(function ($ad) {
            for ($i = 0; $i < 2; $i++)
                DB::table('ad_tag')->insert([
                    'ad_id' => $ad->id,
                    'tag_id' => rand(1, 20)
                ]);
        });
    }
}
