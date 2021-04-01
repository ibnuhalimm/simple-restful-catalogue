<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_category_id' => ProductCategory::factory(),
            'name' => Str::limit($this->faker->words(3, true), 100),
            'description' => $this->faker->text(),
            'is_new' => $this->faker->boolean(),
            'weight_gram' => $this->faker->numberBetween(100, 10000),
            'flag_variant' => $this->faker->randomElement([Product::FLAG_VARIANT_AS_PRODUCT, Product::FLAG_VARIANT_AS_VARIANT])
        ];
    }
}
