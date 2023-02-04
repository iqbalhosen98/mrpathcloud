<?php

namespace Mrpath\Velocity\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * OrderBrands Repository
 *
 * @copyright 2019 Mrpath Software Pvt Ltd (http://www.mrpath.com)
 */
class OrderBrandsRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Velocity\Contracts\OrderBrand';
    }

}