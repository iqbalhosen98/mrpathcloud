<?php

namespace Mrpath\Sales\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Mrpath\Sales\Contracts\OrderAddress;

/**
 * Order Address Repository
 *
 * @author    Jitendra Singh <jitendra@mrpath.com>
 * @copyright 2018 Mrpath Software Pvt Ltd (http://www.mrpath.com)
 */
class OrderAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    function model()
    {
        return OrderAddress::class;
    }
}