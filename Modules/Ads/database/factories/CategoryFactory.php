<?php

namespace Modules\Ads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ads\App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Modules\Ads\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
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
