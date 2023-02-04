<?php

namespace Mrpath\CatalogRule\Listeners;

use Mrpath\CatalogRule\Helpers\CatalogRuleIndex;

class Product
{
    /**
     * Product Repository Object
     * 
     * @var \Mrpath\CatalogRule\Helpers\CatalogRuleIndex
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new listener instance.
     * 
     * @param  \Mrpath\CatalogRule\Helpers\CatalogRuleIndex  $catalogRuleIndexHelper
     * @return void
     */
    public function __construct(CatalogRuleIndex $catalogRuleIndexHelper)
    {
        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }

    /**
     * @param  \Mrpath\Product\Contracts\Product  $product
     * @return void
     */
    public function createProductRuleIndex($product)
    {
        $this->catalogRuleIndexHelper->reindexProduct($product);
    }
}