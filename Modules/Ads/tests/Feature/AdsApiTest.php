<?php

namespace Modules\Ads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Ads\App\Models\Ad;
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
