<?php

namespace Mrpath\CatalogRule\Repositories;

use Mrpath\Core\Eloquent\Repository;

class CatalogRuleProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\CatalogRule\Contracts\CatalogRuleProduct';
    }
}