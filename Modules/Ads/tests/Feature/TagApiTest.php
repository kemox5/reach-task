<?php

namespace Modules\Ads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Ads\App\Models\Tag;
use Tests\TestCase;

class TagApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    private const BASE = '/api/tag';

    public function test_required_fields()
    {
        $response = $this->post(self::BASE, [], ['accept' => 'application/json']);
        $response
            ->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.name');
                $json->etc();
            });
    }

    public function test_unique_fields()
    {
        $tag = Tag::factory()->create()->toArray();

        $response = $this->post(self::BASE, $tag, ['accept' => 'application/json']);
        $response
            ->assertStatus(422)
            ->assertJson(function ($json) {
                $json->where('success', false);
                $json->has('errors.name');
                $json->etc();
            });
    }

    public function test_create()
    {
        $tag = Tag::factory()->make()->toArray();
        $response = $this->post(self::BASE,  $tag, ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('tags', 1);
    }

    public function test_read()
    {
        $tag = Tag::factory()->create();
        $response = $this->get(self::BASE . '/' . $tag->id, ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) use ($tag) {
                $json->where('data.id', $tag->id)
                    ->etc();
            });
    }

    public function test_update()
    {
        $tag = Tag::factory()->create();
        $response = $this->put(self::BASE . '/' . $tag->id, ['name' => 'updated name'], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tags', ['name' => 'updated name']);
    }

    public function test_delete()
    {
        $tag = Tag::factory()->create();
        $response = $this->delete(self::BASE . '/' . $tag->id, [], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('tags', 0);
    }

    public function test_read_404()
    {
        $response = $this->get(self::BASE . '/1', ['accept' => 'application/json']);
        $response->assertStatus(404);
    }

    public function test_list_tags_and_pagination()
    {
        Tag::factory(10)->create();
        $response = $this->get(self::BASE . '?page=1&page_size=5',  ['accept' => 'application/json']);


        $response->assertStatus(200)
            ->assertJsonCount(5, "data.items")
            ->assertJson(function ($json) {
                $json->where('success', true);
                $json->where('data.total', 10);
                $json->etc();
            });
    }
}
