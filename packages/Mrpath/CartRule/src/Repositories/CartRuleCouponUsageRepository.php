<?php

namespace Mrpath\CartRule\Repositories;

use Mrpath\Core\Eloquent\Repository;

class CartRuleCouponUsageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\CartRule\Contracts\CartRuleCouponUsage';
    }
}