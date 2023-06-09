<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Product, Category};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */    
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();
        return [
            //
            'title' => $this->faker->word(),
            'category_id' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph()
        ];
    }
}
