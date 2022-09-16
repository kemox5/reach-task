<?php

namespace Modules\Ads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Ads\App\Models\Category;
use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    private const BASE = '/api/category';

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

    public function test_create()
    {
        $category = Category::factory()->make()->toArray();
        $response = $this->post(self::BASE,  $category, ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('ads', 1);
    }

    public function test_read()
    {
        $category = Category::factory()->create();
        $response = $this->get(self::BASE . '/' . $category->id, ['accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJson(function ($json) use ($category) {
                $json->where('data.id', $category->id)
                    ->etc();
            });
    }

    public function test_update()
    {
        $category = Category::factory()->create();
        $response = $this->put(self::BASE . '/' . $category->id, ['description' => 'updated description'], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('ads', ['description' => 'updated description']);
    }

    public function test_delete()
    {
        $category = Category::factory()->create();
        $response = $this->delete(self::BASE . $category->id, [], ['accept' => 'application/json']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('ads', 0);
    }

    public function test_read_404()
    {
        $response = $this->get(self::BASE . '/1', ['accept' => 'application/json']);
        $response->assertStatus(404);
    }
}
