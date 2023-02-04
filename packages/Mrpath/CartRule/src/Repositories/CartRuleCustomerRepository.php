<?php

namespace Mrpath\CartRule\Repositories;

use Mrpath\Core\Eloquent\Repository;

class CartRuleCustomerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\CartRule\Contracts\CartRuleCustomer';
    }
}