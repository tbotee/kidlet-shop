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
        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category->id,
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'stock' => 1,
            'image_path' => $this->getImagePath($category->slug),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function getImagePath($slug)
    {
        return match ($slug) {
            config('constants.category_slug.womens') =>
                $this->faker->randomElement(['women-01.jpg', 'women-02.jpg', 'women-03.jpg']),
            config('constants.category_slug.mens') =>
                $this->faker->randomElement(['men-01.jpg', 'men-02.jpg', 'men-03.jpg']),
            config('constants.category_slug.kids') =>
                $this->faker->randomElement(['kid-01.jpg', 'kid-02.jpg', 'kid-03.jpg']),
            default => '',
        };
    }
}
