<?php

namespace Modules\Ads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Ads\App\Models\Ad;
use Modules\Ads\App\Models\Advertiser;
use Modules\Ads\App\Models\Category;
use Modules\Ads\App\Models\Tag;
use Tests\TestCase;

class AdsApiTest extends TestCase
{
    use RefreshDatabase;

    private const BASE = '/api/ad';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_required_fields()
    {
        $response = $this->post(self::BASE, [], ['accept' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.type');
                $json->has('errors.title');
                $json->has('errors.description');
                $json->has('errors.category_id');
                $json->has('errors.advertiser_id');
                $json->has('errors.start_date');
                $json->etc();
            });
    }


    public function test_filter_by_category()
    {
        Category::factory(2)->create()->each(function ($category) {
            Ad::factory(3)->create([
                'category_id' => $category->id
            ]);
        });

        $response = $this->get(self::BASE . '?filters[category_id]=2',  ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) {
                $json->where('success', true);
                $json->has('data.items', '3', function ($j) {
                    $j->where('category_id', 2)->etc();
                });
                $json->etc();
            });
    }

    public function test_filter_by_advertiser()
    {
        Advertiser::factory(2)->create()->each(function ($advertiser) {
            Ad::factory(3)->create([
                'advertiser_id' => $advertiser->id
            ]);
        });

        $response = $this->get(self::BASE . '?filters[advertiser_id]=2',  ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) {
                $json->where('success', true);
                $json->has('data.items', '3', function ($j) {
                    $j->where('advertiser_id', 2)->etc();
                });
                $json->etc();
            });
    }

    public function test_filter_by_tags()
    {
        $tag = Tag::factory()->create();

        Ad::factory(3)->create()->first()->tags()->sync($tag->id);

        $response = $this->get(self::BASE . '?filters[tag_id]=' . $tag->id,  ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) {
                $json->where('success', true);
                $json->has('data.items', '1');
                $json->etc();
            });
    }


    public function test_list_ads_and_pagination()
    {
        $ad = Ad::factory(10)->create();
        $response = $this->get(self::BASE . '?page=1&page_size=5',  ['accept' => 'application/json']);


        $response->assertStatus(200)
            ->assertJsonCount(5, "data.items")
            ->assertJson(function ($json) {
                $json->where('success', true);
                $json->where('data.total', 10);
                $json->etc();
            });
    }



    public function test_advertiser_exists_validation_in_create()
    {
        $ad = Ad::factory()->create()->toArray();
        $ad['advertiser_id'] = 500;

        $response = $this->post(self::BASE,  $ad, ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.advertiser_id');
                $json->etc();
            });
    }



    public function test_advertiser_exists_validation_in_update()
    {
        $ad = Ad::factory()->create();

        $response = $this->put(self::BASE . '/' . $ad->id,  ['advertiser_id' => 5], ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.advertiser_id');
                $json->etc();
            });
    }

    public function test_category_exists_validation_in_create()
    {
        $ad = Ad::factory()->make()->toArray();
        $ad['category_id'] = 500;

        $response = $this->post(self::BASE,  $ad, ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.category_id');
                $json->etc();
            });
    }


    public function test_category_exists_validation_in_update()
    {
        $ad = Ad::factory()->create();

        $response = $this->put(self::BASE . '/' . $ad->id,  ['category_id' => 5], ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.category_id');
                $json->etc();
            });
    }


    public function test_tags_exists_validation_in_create()
    {
        $ad = Ad::factory()->make()->toArray();
        $ad['tags'] = [1, 2, 3];

        $response = $this->post(self::BASE,  $ad, ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->etc();
            });;
    }


    public function test_tags_exists_validation_in_update()
    {
        $ad = Ad::factory()->create();

        $response = $this->put(self::BASE . '/' . $ad->id,  ['tags' => [1, 3, 5, 4]], ['accept' => 'application/json']);
        $response->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->etc();
            });
    }

    public function test_tags_relation_created()
    {
        $tags = Tag::factory(3)->create();

        $ad = Ad::factory()->make()->toArray();
        $ad['tags'] =  $tags->pluck('id')->toArray();
        $response = $this->post(self::BASE,  $ad, ['accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('ad_tag', [
            'ad_id' => 1,
            'tag_id' => 2
        ])
            ->assertDatabaseCount('ad_tag', 3);
    }


    public function test_create()
    {
        $ad = Ad::factory()->make()->toArray();
        $response = $this->post(self::BASE,  $ad, ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('ads', 1);
    }

    public function test_read()
    {
        $ad = Ad::factory()->create();
        $response = $this->get(self::BASE . '/' . $ad->id, ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) use ($ad) {
                $json->where('data.id', $ad->id)
                    ->etc();
            });
    }

    public function test_update()
    {
        $ad = Ad::factory()->create();
        $response = $this->put(self::BASE . '/' . $ad->id, ['description' => 'updated description'], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('ads', ['description' => 'updated description']);
    }

    public function test_delete()
    {
        $ad = Ad::factory()->create();
        $response = $this->delete(self::BASE . '/' . $ad->id, [], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('ads', 0);
    }

    public function test_read_404()
    {
        $response = $this->get(self::BASE . '/1', ['accept' => 'application/json']);
        $response->assertStatus(404);
    }
}
