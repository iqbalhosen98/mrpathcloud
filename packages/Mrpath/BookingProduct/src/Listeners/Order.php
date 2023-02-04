<?php

namespace Mrpath\BookingProduct\Listeners;

use Mrpath\BookingProduct\Repositories\BookingRepository;

class Order
{
    /**
     * BookingRepository Object
     *
     * @var \Mrpath\BookingProduct\Repositories\BookingRepository
     */
    protected $bookingRepository;

    /**
     * Create a new listener instance.
     *
     * @param  \Mrpath\Booking\Repositories\BookingRepository  $bookingRepository
     * @return void
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * After sales order creation, add entry to bookings table
     *
     * @param \Mrpath\Sales\Contracts\Order  $order
     */
    public function afterPlaceOrder($order)
    {
        $this->bookingRepository->create(['order' => $order]);
    }
}