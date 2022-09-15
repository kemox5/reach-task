<?php

namespace Modules\Ads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ads\App\Models\Advertiser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Modules\Ads\App\Models\Advertiser>
 */
class AdvertiserFactory extends Factory
{
    protected $model = Advertiser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
