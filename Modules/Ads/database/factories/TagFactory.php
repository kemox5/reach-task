<?php

namespace Modules\Ads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ads\App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Modules\Ads\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->word(),
        ];
    }
}
