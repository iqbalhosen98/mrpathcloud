<?php

namespace Mrpath\Velocity\Repositories;

use Mrpath\Core\Eloquent\Repository;

class VelocityMetadataRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Velocity\Contracts\VelocityMetadata';
    }
}