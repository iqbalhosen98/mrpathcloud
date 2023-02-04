<?php

namespace Mrpath\Product\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Product\Models\Product::class,
        \Mrpath\Product\Models\ProductAttributeValue::class,
        \Mrpath\Product\Models\ProductFlat::class,
        \Mrpath\Product\Models\ProductImage::class,
        \Mrpath\Product\Models\ProductInventory::class,
        \Mrpath\Product\Models\ProductOrderedInventory::class,
        \Mrpath\Product\Models\ProductReview::class,
        \Mrpath\Product\Models\ProductSalableInventory::class,
        \Mrpath\Product\Models\ProductDownloadableSample::class,
        \Mrpath\Product\Models\ProductDownloadableLink::class,
        \Mrpath\Product\Models\ProductGroupedProduct::class,
        \Mrpath\Product\Models\ProductBundleOption::class,
        \Mrpath\Product\Models\ProductBundleOptionTranslation::class,
        \Mrpath\Product\Models\ProductBundleOptionProduct::class,
        \Mrpath\Product\Models\ProductCustomerGroupPrice::class,
        \Mrpath\Product\Models\ProductVideo::class,
        \Mrpath\Product\Models\ProductReviewImage::class,
    ];
}