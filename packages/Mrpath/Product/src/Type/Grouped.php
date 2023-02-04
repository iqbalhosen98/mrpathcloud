<?php

namespace Mrpath\Product\Type;

use Mrpath\Attribute\Repositories\AttributeRepository;
use Mrpath\Product\Models\ProductFlat;
use Mrpath\Product\Repositories\ProductAttributeValueRepository;
use Mrpath\Product\Repositories\ProductGroupedProductRepository;
use Mrpath\Product\Repositories\ProductImageRepository;
use Mrpath\Product\Repositories\ProductInventoryRepository;
use Mrpath\Product\Repositories\ProductRepository;
use Mrpath\Product\Repositories\ProductVideoRepository;

class Grouped extends AbstractType
{
    /**
     * Product grouped product repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductGroupedProductRepository
     */
    protected $productGroupedProductRepository;

    /**
     * Skip attribute for downloadable product type.
     *
     * @var array
     */
    protected $skipAttributes = ['price', 'cost', 'special_price', 'special_price_from', 'special_price_to', 'length', 'width', 'height', 'weight'];

    /**
     * These blade files will be included in product edit page.
     *
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.videos',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.grouped-products',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links',
    ];

    /**
     * Is a composite product type.
     *
     * @var boolean
     */
    protected $isComposite = true;

    /**
     * Create a new product type instance.
     *
     * @param  \Mrpath\Attribute\Repositories\AttributeRepository            $attributeRepository
     * @param  \Mrpath\Product\Repositories\ProductRepository                $productRepository
     * @param  \Mrpath\Product\Repositories\ProductAttributeValueRepository  $attributeValueRepository
     * @param  \Mrpath\Product\Repositories\ProductInventoryRepository       $productInventoryRepository
     * @param  \Mrpath\Product\Repositories\ProductImageRepository           $productImageRepository
     * @param  \Mrpath\Product\Repositories\ProductGroupedProductRepository  $productGroupedProductRepository
     * @param  \Mrpath\Product\Repositories\ProductVideoRepository           $productVideoRepository
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProductAttributeValueRepository $attributeValueRepository,
        ProductInventoryRepository $productInventoryRepository,
        ProductImageRepository $productImageRepository,
        ProductGroupedProductRepository $productGroupedProductRepository,
        ProductVideoRepository $productVideoRepository
    ) {
        parent::__construct(
            $attributeRepository,
            $productRepository,
            $attributeValueRepository,
            $productInventoryRepository,
            $productImageRepository,
            $productVideoRepository
        );

        $this->productGroupedProductRepository = $productGroupedProductRepository;
    }

    /**
     * Update.
     *
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \Mrpath\Product\Contracts\Product
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        $product = parent::update($data, $id, $attribute);

        $route = request()->route() ? request()->route()->getName() : '';

        if ($route != 'admin.catalog.products.massupdate') {
            $this->productGroupedProductRepository->saveGroupedProducts($data, $product);
        }

        return $product;
    }

    /**
     * Returns children ids.
     *
     * @return array
     */
    public function getChildrenIds()
    {
        return array_unique($this->product->grouped_products()->pluck('associated_product_id')->toArray());
    }

    /**
     * Check if catalog rule can be applied.
     *
     * @return bool
     */
    public function priceRuleCanBeApplied()
    {
        return false;
    }

    /**
     * Get product minimal price.
     *
     * @param  int  $qty
     * @return float
     */
    public function getMinimalPrice($qty = null)
    {
        $minPrices = [];

        foreach ($this->product->grouped_products as $groupOptionProduct) {
            $groupOptionProductTypeInstance = $groupOptionProduct->associated_product->getTypeInstance();

            $groupOptionProductMinimalPrice = $groupOptionProductTypeInstance->getMinimalPrice();

            $minPrices[] = $groupOptionProductTypeInstance->evaluatePrice($groupOptionProductMinimalPrice);
        }

        return empty($minPrices) ? 0 : min($minPrices);
    }

    /**
     * Is saleable.
     *
     * @return bool
     */
    public function isSaleable()
    {
        if (! $this->product->status) {
            return false;
        }

        if (ProductFlat::query()->select('id')->whereIn('product_id', $this->getChildrenIds())->where('status', 0)->first()) {
            return false;
        }

        return true;
    }

    /**
     * Check whether group product have special price.
     *
     * @param  int  $qty
     * @return bool
     */
    public function haveSpecialPrice($qty = null)
    {
        $haveSpecialPrice = false;

        foreach ($this->product->grouped_products as $groupOptionProduct) {
            if ($groupOptionProduct->associated_product->getTypeInstance()->haveSpecialPrice()) {
                $haveSpecialPrice = true;

                break;
            }
        }

        return $haveSpecialPrice;
    }

    /**
     * Get product minimal price.
     *
     * @return string
     */
    public function getPriceHtml()
    {
        $html = '';

        if ($this->haveSpecialPrice()) {
            $html .= '<div class="sticker sale">' . trans('shop::app.products.sale') . '</div>';
        }

        $html .= '<span class="price-label">' . trans('shop::app.products.starting-at') . '</span>'
        . ' '
        . '<span class="final-price">' . core()->currency($this->getMinimalPrice()) . '</span>';

        return $html;
    }

    /**
     * Add product. Returns error message if can't prepare product.
     *
     * @param  array  $data
     * @return array
     */
    public function prepareForCart($data)
    {
        if (! isset($data['qty']) || ! is_array($data['qty'])) {
            return trans('shop::app.checkout.cart.integrity.missing_options');
        }

        $products = [];

        foreach ($data['qty'] as $productId => $qty) {
            if (! $qty) {
                continue;
            }

            $product = $this->productRepository->find($productId);

            $cartProducts = $product->getTypeInstance()->prepareForCart([
                'product_id' => $productId,
                'quantity'   => $qty,
            ]);

            if (is_string($cartProducts)) {
                return $cartProducts;
            }

            $products = array_merge($products, $cartProducts);
        }

        if (! count($products)) {
            return trans('shop::app.checkout.cart.integrity.qty_missing');
        }

        return $products;
    }
}
