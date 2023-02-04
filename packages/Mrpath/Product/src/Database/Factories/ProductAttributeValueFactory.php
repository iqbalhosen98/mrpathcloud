<?php

namespace Mrpath\Product\Database\Factories;

use Mrpath\Product\Models\Product;
use Mrpath\Product\Models\ProductAttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAttributeValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            //'product_id' => Product::factory(),
            'locale' => 'en',
            'channel' => 'default',
        ];
    }
}