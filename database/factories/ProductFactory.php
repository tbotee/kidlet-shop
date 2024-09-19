<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $randomEmail = $this->faker->unique()->safeEmail;
        $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($randomEmail))) . '?d=monsterid&s=350';

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'stock' => 1,
            'image_path' => $gravatarUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
