<?php

namespace Mrpath\Product\Database\Factories;

use Mrpath\Product\Models\ProductDownloadableLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mrpath\Product\Models\ProductDownloadableLinkTranslation;

class ProductDownloadableLinkTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDownloadableLinkTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'locale' => 'en',
            'title' => $this->faker->word,
            'product_downloadable_link_id' => ProductDownloadableLink::factory(),
        ];
    }
}
