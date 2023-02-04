<?php

namespace Mrpath\Velocity\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class ContentTranslationRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Velocity\Contracts\ContentTranslation';
    }
}