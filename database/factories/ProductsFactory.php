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
        $imgList = ['pic-1.webp','pic-2.webp'];
        return [
            'description'=>fake()->text(150),
            'price'=>fake()->numberBetween(100,100000),
            'img'=>fake()->randomElement($imgList),
            'discount'=>fake()->numberBetween(0,20)
        ];
    }
}
