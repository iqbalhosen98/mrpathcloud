<?php

namespace Mrpath\Sales\Repositories;

use Mrpath\Core\Eloquent\Repository;
use Mrpath\Sales\Contracts\OrderComment;

class OrderCommentRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderComment::class;
    }
}
