<?php

namespace Modules\Ads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ads\App\Models\Ad;
use Modules\Ads\App\Models\Advertiser;
use Modules\Ads\App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Modules\Ads\App\Models\Ad>
 */
class AdFactory extends Factory
{
    protected $model = Ad::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => fake()->randomElement(['free', 'paid']),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'category_id' => (Category::count() > 5) ? Category::inRandomOrder()->first()->id : Category::factory(),
            'advertiser_id' => (Advertiser::count() > 5) ? Advertiser::inRandomOrder()->first()->id : Advertiser::factory(),
            'start_date' => fake()->dateTimeBetween('now', '+12 months')->format('Y-m-d'),
        ];
    }
}
