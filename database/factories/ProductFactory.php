<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word().' '.$this->faker->word(),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->numberBetween(100, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $this->faker->numberBetween(1, 7),
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => $this->faker->slug(),
            'thumbnail' => $this->faker->imageUrl(),
            'cost_price' => $this->faker->numberBetween(100, 1000),
            'sku' => $this->faker->regexify('[A-Z0-9]{10}'),
            'weight' => $this->faker->numberBetween(100, 1000),
            'brand_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
