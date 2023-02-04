<?php

namespace Mrpath\Product\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Mrpath\Product\Repositories\ProductRepository;
use Illuminate\Support\Str;

class ProductGroupedProductRepository extends Repository
{
    public function model()
    {
        return 'Mrpath\Product\Contracts\ProductGroupedProduct';
    }

    /**
     * @param  array  $data
     * @param  \Mrpath\Product\Contracts\Product  $product
     * @return void
     */
    public function saveGroupedProducts($data, $product)
    {
        $previousGroupedProductIds = $product->grouped_products()->pluck('id');

        if (isset($data['links'])) {
            foreach ($data['links'] as $linkId => $linkInputs) {
                if (Str::contains($linkId, 'link_')) {
                    $this->create(array_merge([
                        'product_id' => $product->id,
                    ], $linkInputs));
                } else {
                    if (is_numeric($index = $previousGroupedProductIds->search($linkId))) {
                        $previousGroupedProductIds->forget($index);
                    }

                    $this->update($linkInputs, $linkId);
                }
            }
        }

        foreach ($previousGroupedProductIds as $previousGroupedProductId) {
            $this->delete($previousGroupedProductId);
        }
    }
}