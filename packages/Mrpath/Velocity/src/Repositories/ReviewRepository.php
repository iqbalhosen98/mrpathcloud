<?php

namespace Mrpath\Velocity\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Review Repository
 *
 * @copyright 2019 Mrpath Software Pvt Ltd (http://www.mrpath.com)
 */
class ReviewRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Mrpath\Product\Contracts\ProductReview';
    }


    function getAll()
    {
        $reviews = $this->model->get();

        return $reviews;
    }
}