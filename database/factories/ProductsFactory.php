<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imgList = [
            'web-1.jpg',
            'web-2.jpg',
            'web-3.jpg',
            'web-4.jpg',
            'web-5.jpg',
            ];
        return [
            'description'=>fake()->text(150),
            'price'=>fake()->numberBetween(100,10000),
            'img'=>fake()->randomElement($imgList),
            'discount'=>fake()->boolean()
        ];
    }
}
