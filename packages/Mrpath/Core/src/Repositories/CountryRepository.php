<?php

namespace Mrpath\Core\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class CountryRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\Core\Contracts\Country';
    }
}