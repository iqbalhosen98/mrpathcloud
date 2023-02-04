<?php

namespace Mrpath\Checkout\Repositories;

use Mrpath\Core\Eloquent\Repository;

/**
 * Cart Address Repository
 *
 * @author    Prashant Singh <prashant.singh852@mrpath.com>
 * @copyright 2018 Mrpath Software Pvt Ltd (http://www.mrpath.com)
 */
class CartAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Checkout\Contracts\CartAddress';
    }
}