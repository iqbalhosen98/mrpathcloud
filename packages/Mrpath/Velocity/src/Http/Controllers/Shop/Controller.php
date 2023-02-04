<?php

namespace Mrpath\Velocity\Http\Controllers\Shop;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Mrpath\Velocity\Helpers\Helper;
use Mrpath\Product\Repositories\SearchRepository;
use Mrpath\Product\Repositories\ProductRepository;
use Mrpath\Customer\Repositories\WishlistRepository;
use Mrpath\Category\Repositories\CategoryRepository;
use Mrpath\Velocity\Repositories\Product\ProductRepository as VelocityProductRepository;
use Mrpath\Velocity\Repositories\VelocityCustomerCompareProductRepository as CustomerCompareProductRepository;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * SearchRepository object
     *
     * @var \Mrpath\Product\Repositories\SearchRepository
     */
    protected $searchRepository;

    /**
     * ProductRepository object
     *
     * @var \Mrpath\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductRepository object of velocity package
     *
     * @var \Mrpath\Velocity\Repositories\Product\ProductRepository
     */
    protected $velocityProductRepository;

    /**
     * CategoryRepository object of velocity package
     *
     * @var \Mrpath\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * WishlistRepository object
     *
     * @var \Mrpath\Customer\Repositories\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * Helper object
     *
     * @var \Mrpath\Velocity\Helpers\Helper
     */
    protected $velocityHelper;

    /**
     * VelocityCustomerCompareProductRepository object of repository
     *
     * @var \Mrpath\Velocity\Repositories\VelocityCustomerCompareProductRepository
     */
    protected $compareProductsRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\Velocity\Helpers\Helper                                         $velocityHelper
     * @param  \Mrpath\Product\Repositories\SearchRepository                           $searchRepository
     * @param  \Mrpath\Product\Repositories\ProductRepository                          $productRepository
     * @param  \Mrpath\Category\Repositories\CategoryRepository                        $categoryRepository
     * @param  \Mrpath\Velocity\Repositories\Product\ProductRepository                 $velocityProductRepository
     * @param  \Mrpath\Velocity\Repositories\VelocityCustomerCompareProductRepository  $compareProductsRepository
     *
     * @return void
     */
    public function __construct(
        Helper $velocityHelper,
        SearchRepository $searchRepository,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository,
        CategoryRepository $categoryRepository,
        VelocityProductRepository $velocityProductRepository,
        CustomerCompareProductRepository $compareProductsRepository
    ) {
        $this->_config = request('_config');

        $this->velocityHelper = $velocityHelper;

        $this->searchRepository = $searchRepository;

        $this->productRepository = $productRepository;

        $this->categoryRepository = $categoryRepository;

        $this->wishlistRepository = $wishlistRepository;

        $this->velocityProductRepository = $velocityProductRepository;

        $this->compareProductsRepository = $compareProductsRepository;
    }
}
