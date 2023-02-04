<?php

namespace Mrpath\BookingProduct\Repositories;

use Mrpath\Core\Eloquent\Repository;

class BookingProductDefaultSlotRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\BookingProduct\Contracts\BookingProductDefaultSlot';
    }
}