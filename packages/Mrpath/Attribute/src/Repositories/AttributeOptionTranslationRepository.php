<?php

namespace Mrpath\Attribute\Repositories;

use Mrpath\Core\Eloquent\Repository;

class AttributeOptionTranslationRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\Attribute\Contracts\AttributeOptionTranslation';
    }
}