<?php

namespace Mrpath\Velocity\Repositories;

use Mrpath\Core\Eloquent\Repository;

class VelocityCustomerCompareProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Velocity\Contracts\VelocityCustomerCompareProduct';
    }
}