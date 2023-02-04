<?php

namespace Mrpath\BookingProduct\Database\Factories;

use Carbon\Carbon;
use Mrpath\BookingProduct\Models\BookingProduct;
use Mrpath\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $bookingTypes = ['event'];

        return [
            'type'           => $bookingTypes[array_rand(['event'])],
            'qty'            => $this->faker->randomNumber(2),
            'available_from' => Carbon::yesterday(),
            'available_to'   => Carbon::tomorrow(),
            'product_id'     => Product::factory(['type' => 'booking']),
        ];
    }
}